@extends('admin')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection

@section('content')
<div >
<h3> Categories Details</h3>

<div class="d-flex justify-content-end">
    <div class="dropdown m-1">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
            aria-expanded="false">
            Column
        </button>
        <div id="columnSelector" class="dropdown-menu"> </div>
    </div>
    <a href="{{ route('admin.category.create') }}" class="btn btn-success m-1">

            Create Category

    </a>
</div>
<div class="">
    <div class="card-body">
    <div class="table-responsive">
        <table  id="Category" class="table">
            <thead>
                <tr>
                    <th scope="col">N#</th>
						<th scope="col">Name</th>
						<th scope="col">Slug</th>
						<th scope="col">Description</th>
						<th scope="col">ImageUrl</th>
						<th scope="col">IsMega</th>
						
						<th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
						<tr><td>{{ $category->id }}</td>
							<td>{{ $category->name }}</td>
							<td>{{ $category->slug }}</td>
							<td>{{ $category->description }}</td>
							<td>
                            <div class="form-group d-flex" id="preview_imageUrl" style="max-width: 100%;">
                                <img src="{{  Str::startsWith($category->imageUrl, 'http') ? $category->imageUrl : Storage::url($category->imageUrl) }}"
                                     alt="Prévisualisation de l'image"
                                     style="max-width: 100px; display: block;">
                            </div>
                        </td>
							    <td>
    <div class="form-check form-switch">
        <input name="isMega" id="isMega" data-id="{{$category->id}}" value="true" data-bs-toggle="toggle"  {{ isset($category) && $category->isMega == 'true' ? 'checked' : '' }} class="form-check-input" type="checkbox" role="switch" />
    </div>
</td>
						<td>
                    <a href="{{ route('admin.category.show', ['id' => $category->id]) }}" class="btn btn-primary btn-sm">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    <a href="{{ route('admin.category.edit', ['id' => $category->id]) }}" class="btn btn-success btn-sm">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </a>
                    <a href="#" data-id="{{ $category->id }}" class="btn btn-danger btn-sm deleteBtn">
                        <i class="fa-solid fa-trash"></i>
                    </a>
                </td>
						</tr>
					@endforeach
            </tbody>
        </table>
    </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $categories->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
</div>


    <!-- Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            <h3 class="modal-title fs-5" id="confirmModalLabel">Delete confirm</h3>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            ...
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            <button type="button" class="btn btn-primary confirmDeleteAction">Delete</button>
            </div>
        </div>
        </div>
    </div>
@endsection
@section('scripts')
   
    <script>
        const checkboxs = document.querySelectorAll('input[type="checkbox"]')

        checkboxs.forEach((checkbox) => {

        checkbox.onchange = async (event) => {
            const { checked, name, dataset } = event.target;
            const { id } = dataset;
            console.log({ checked, name, id });
            const data = { [name]: checked.toString() };
            const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            const response = await fetch('/admin/categories/speed/' + id, {
                method: 'PUT',
                body: JSON.stringify(data), // Utilisation de JSON.stringify au lieu de JSON.stringfy
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            });
        };
        })
        
        const deleteButtons = document.querySelectorAll('.deleteBtn')
        deleteButtons.forEach(deleteButton => {
            deleteButton.addEventListener('click', (event)=>{
                event.preventDefault();
                const { id , title } = deleteButton.dataset
                const modalBody = document.querySelector('.modal-body')
                modalBody.innerHTML = `Are you sure you want to delete this data ?</strong> `
                console.log({ id , title });
                const modal = new bootstrap.Modal(document.querySelector('#confirmModal'))
                modal.show()
                const confirmDeleteBtn = document.querySelector('.confirmDeleteAction')

                confirmDeleteBtn.addEventListener('click',async ()=>{
                    const csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
                    const response = await fetch('/admin/categories/delete/'+id , {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    })

                    const result = await response.json()

                    if(result && result.isSuccess){
                        window.location.href = window.location.href;
                    }


                    modal.hide()
                })
            })

        });
        document.addEventListener('DOMContentLoaded', function() {
            const tableHeaders = document.querySelectorAll('#Category th');
            const columnSelector = document.getElementById('columnSelector');

            tableHeaders.forEach(function(header, index) {
                const li = document.createElement('li');
                const a = document.createElement('a');
                const div = document.createElement('div');
                a.className = 'dropdown-item';
                div.className = 'form-check form-switch';
                const label = document.createElement('label');
                const checkbox = document.createElement('input');
                checkbox.type = 'checkbox';
                checkbox.role="switch"
                checkbox.className = 'columnSelector form-check-input';
                checkbox.dataset.column = index;
                const savedSelection = localStorage.getItem('selectedColumns#Category');
                checkbox.checked = !!!savedSelection; // Sélectionner par défaut
                checkbox.addEventListener('change', function() {
                    const columnIndex = parseInt(checkbox.dataset.column);
                    toggleColumn(columnIndex, checkbox.checked);
                    saveSelection();
                });

                label.appendChild(document.createTextNode(header.textContent));
                div.appendChild(label)
                div.appendChild(checkbox)
                a.appendChild(div);
                li.appendChild(a);
                columnSelector.appendChild(li);

                header.addEventListener('click', function() {
                    sortTable(index);
                });

                if (savedSelection) {
                    const selectedColumns = JSON.parse(savedSelection);
                    toggleColumn(parseInt(index), selectedColumns.includes(index));
                }
            });


            const checkboxes = document.querySelectorAll('.columnSelector');

            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const columnIndex = parseInt(checkbox.dataset.column);
                    toggleColumn(columnIndex, checkbox.checked);

                    // Sauvegarde la sélection dans le localStorage
                    saveSelection();
                });
            });

            // Chargement des valeurs sauvegardées dans le localStorage
            loadSavedSelection();
        });

        function toggleColumn(columnIndex, show) {
            const dataTable = document.getElementById('Category');
            const cells = dataTable.querySelectorAll(
                `tr td:nth-child(${columnIndex + 1}), th:nth-child(${columnIndex + 1})`);

            cells.forEach(function(cell) {
                if (show) {
                    cell.style.display = ''; // Affiche la colonne
                } else {
                    cell.style.display = 'none'; // Masque la colonne
                }
            });
        }

        function saveSelection() {
            const selectedColumns = Array.from(document.querySelectorAll('.columnSelector'))
                .filter(c => c.checked)
                .map(c => c.dataset.column);
            localStorage.setItem('selectedColumns#Category', JSON.stringify(selectedColumns));
        }

        function loadSavedSelection() {
            const savedSelection = localStorage.getItem('selectedColumns#Category');
            if (savedSelection) {
                const selectedColumns = JSON.parse(savedSelection);
                selectedColumns.forEach(function(columnIndex) {
                    const checkbox = document.querySelector(`.columnSelector[data-column="${columnIndex}"]`);
                    if (checkbox) {
                        checkbox.checked = true;
                        toggleColumn(parseInt(columnIndex), true);
                    }
                });
            }
        }

        function sortTable(columnIndex) {
            const table = document.getElementById('Category');
            const rows = Array.from(table.querySelectorAll('tbody tr'));

            console.log({rows});

            rows.sort((a, b) => {
                const cellA = a.querySelectorAll('td')[columnIndex].textContent;
                const cellB = b.querySelectorAll('td')[columnIndex].textContent;

                return cellA.localeCompare(cellB, undefined, { numeric: true, sensitivity: 'base' });
            });

            table.querySelector('tbody').innerHTML = '';
            rows.forEach(row => table.querySelector('tbody').appendChild(row));
        }
    </script>
@endsection