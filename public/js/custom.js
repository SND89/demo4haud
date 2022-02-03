var countriesTag = '#customersDT';

jQuery(function() {
    'use strict'
    //GLOBALS 

    var customersDT = $(countriesTag).DataTable({
        columns: [
            { title: "ID", data: "id" },
            { title: "Name", data: "name" },
            { title: "Email", data: "email" },
            { title: "Username", data: "username" },
            { title: "Blocked", data: "blocked" },
            // { title: "Total Payments", data: "paymnents" },
            {
                title: "Operation",
                data: null,
                className: "center",
                defaultContent: ''

            }
        ],
        columnDefs: [{
                "targets": 4,
                "data": "blocked",
                "render": function(data, type, row, meta) {
                    if (type === 'display') {
                        if (data == '1') {
                            return `<span class="badge bg-danger">BLOCKED</span>`;
                        }
                        return `<span class="badge bg-light text-dark">OK</span>`;
                    }
                    return data;
                }
            },
            {
                "targets": 5,
                "data": null,
                "width": "20%",
                "orderable": false,
                "render": function(data, type, row, meta) {
                    if (type === 'display') {
                        let html = `<button type="button" class="btn btn-primary" onclick="editCustomer(` + meta.row + `)">Edit</button> 
                    <button type="button" onclick="removeCustomer(` + meta.row + `)" class="btn btn-danger">Delete</button>`;
                        return html;
                    }
                }
            }
        ]
    });

    $("#fsearchcustomer").on('submit', (function(event) {
        event.preventDefault()
        event.stopPropagation()
        this.classList.add('was-validated');

        if (this.checkValidity()) {
            let code = jQuery('#customerCodeI').val().toUpperCase();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                "url": this.getAttribute('action') + '/' + code,
                "method": 'GET',
                "dataType": "json",
                "success": function(response) {
                    customersDT.clear();
                    customersDT.rows.add(response).draw();
                },
            });
        }
    }));

    //Create + Edit user modal
    var editCustomerModal = document.getElementById('editCustomerModal');
    editCustomerModal.addEventListener('shown.bs.modal', function() {
        console.log("Shown modal.");
    })

    $("#fcreatecustomer").on('submit', (function(event) {
        event.preventDefault()
        event.stopPropagation()
        this.classList.add('was-validated');

        if (this.checkValidity()) {

            let api = $("#customerCreateLink").val();
            let method = 'POST';
            let ajaxData = $("#fcreatecustomer").serialize();

            if ($("#modeCCF").val() == 'edit') {
                api = $("#customerEditLink").val() + '/' + $("#idCCF").val();
                method = 'PUT';
            }

            console.log(ajaxData);
            $(this).prop('checked');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                "url": api,
                "method": method,
                "data": ajaxData,
                "dataType": "json",
                "success": function(response) {
                    Swal.fire(
                        'Success',
                        'Changes have been saved.',
                        'success'
                    );
                    $(editCustomerModal).modal('toggle');
                },
                "error": function(data, textStatus, jqXHR) {
                    console.log(data.error);
                }
            });
        }
    }));

    $("#createCustomerBTN").on('click', (function(event) {
        clearEditModalFields();
        changeOperation(false);
        $(editCustomerModal).modal('toggle');
    }));

    //End Create + Edit user modal
});

// Handle dialog confirm button click.
$('#fcreateBTN').on('click', function(e) {
    handleInputs();
    $('#fcreatecustomer').trigger('submit');
});


function editCustomer(id) {
    let dt = $(countriesTag).DataTable();
    var data = dt.row(id).data();
    changeOperation(true);
    populateEditModalFields(data);
    $(editCustomerModal).modal('toggle');
}

function removeCustomer(id) {
    let dt = $(countriesTag).DataTable();
    var data = dt.row(id).data();
    deleteCustomer(data);
}

function deleteCustomer(data, rowid) {
    Swal.fire({
        title: 'Are you sure?',
        html: "You won't be able to revert this!<br/>" + "Customer ID: " + data.id + " - Customer Name: " + data.name,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });

            $.ajax({
                "url": $("#customerDeleteLink").val() + '/' + data.id,
                "data": data,
                "method": 'DELETE',
                "dataType": "json",
                "success": function(response) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    let dt = $(countriesTag).DataTable();
                    dt.row(rowid).remove().draw();
                },
            });
        }
    })
}

//Modal operations
function clearEditModalFields() {
    $("#idCCF").val('');
    $("#name").val('');
    $("#email").val('');
    $("#username").val('');
    $("#blocked").prop("checked", true);
}

function populateEditModalFields(data) {
    $("#idCCF").val(data.id);
    $("#name").val(data.name);
    $("#email").val(data.email);
    $("#username").val(data.username);
    $("#blocked").prop("checked", (data.blocked == 1));
}

function handleInputs() {
    $('input[type=checkbox]').each(function() {
        if (!this.checked) {
            $(this).attr("value", "0");
        } else {
            $(this).attr("value", "1");
        }
    });
}

function changeOperation(showEdit) {
    if (showEdit) {
        $("#editCustomerModalCenterTitle").html('Edit user');
        $("#fcreateBTN").html('Save changes');
        $("#modeCCF").val('edit');
    } else {
        $("#editCustomerModalCenterTitle").html('Create user');
        $("#fcreateBTN").html('Create customer');
        $("#modeCCF").val('create');
    }

}