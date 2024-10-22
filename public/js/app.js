document.querySelectorAll('.custom-file-input').forEach(input => {
    input.addEventListener('change', function () {
        var fileName = this.files[0].name;
        var label = this.nextElementSibling;
        label.innerText = fileName;
    });
});
document.getElementById('add-size').addEventListener('click', function () {
    var newRow = document.createElement('div');
    newRow.classList.add('form-row', 'mb-2');

    // Gửi AJAX request để lấy danh sách kích thước
    fetch('/sizes')
        .then(response => response.json())
        .then(data => {
            var sizeOptions = data.map(size => `<option value="${size.size_id}">${size.size_name}</option>`).join('');
            newRow.innerHTML = `
                <div class="col-md-5">
                                                                        <div class="input-group mg-b-pro-edt">
                                                                            <span class="input-group-addon"><i class="icon nalika-unlocked" aria-hidden="true"></i></span>
                                                                            <select name="size_id[]" class="form-control" required>
                                                                                <option value="" selected disabled>Chọn kích thước</option>
                                                                                @foreach ($sizes as $size)
                                                                                <option value="{{ $size->size_id }}">{{ $size->size_name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-5">
                                                                        <div class="input-group mg-b-pro-edt">
                                                                            <span class="input-group-addon"><i class="icon nalika-unlocked" aria-hidden="true"></i></span>
                                                                            <input type="number" name="stock[]" class="form-control" placeholder="Số lượng" required min="0">
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-2">
                                                                        <button type="button" class="btn btn-danger remove-size-row">X</button>
                                                                    </div>
            `;

            document.getElementById('size-stock-container').appendChild(newRow);
            newRow.querySelector('.remove-size-row').addEventListener('click', function () {
                newRow.remove();
            });
        })
        .catch(error => console.error('Error fetching sizes:', error));
});

