$(document).ready(function(){
// Check Admin Password is correct or not!
	$('#curr_pass').keyup(function(){
		var current_pass = $('#curr_pass').val();
		$.ajax({
		    headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    type: 'POST',
		    url: '/admin/check-current-password',
		    data: { current_pass: current_pass },
		    success: function(res) {
		        if (res === 'false') {
		            $('#verify_curr_pass').html('Current Password is Incorrect!').removeClass('text-success').addClass('text-danger');

		        } else if (res === 'true') {
		            $('#verify_curr_pass').html('Current Password is Correct!').removeClass('text-danger').addClass('text-success');
		        }
		    },
		    error: function(xhr, status, error) {
		        alert("Error: " + error);
		    }
		});
	});

// Update CMS Page Status
	$(document).on('click', '.updateCmsPageStatus', function() {        
        var status = $(this).children('i').attr('status');
        var page_id = $(this).attr('id').split('-')[1];    
        $.ajax({
        	headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    type 		:'post',
		    url 		: '/admin/update-cms-page-status',
		    data 		: {status:status,page_id:page_id},
		    success		: function(res){
		    	if (res['status'] == 0) {                
               		 $("#page-" + page_id).html("<i class='fas fa-toggle-off' style='font-size:37px; color:white;' status='inactive'></i>");
                } else if (res['status'] == 1) {
	                $("#page-" + page_id).html("<i class='fas fa-toggle-on' style='font-size:37px; color:green;' status='active'></i>");
	            }
		    }, 
		    error 		: function(xhr, status, error)
		    {
		    	 alert("Error: " + error);
		    }
        });
    });	


//Update Subdomains Page Status 
$(document).on('click', '.updateSubdomainsStatus', function() {        
        var status = $(this).children('i').attr('status');

        var subadmins_id = $(this).attr('id').split('-')[1];    

        $.ajax({
        	headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    type 		:'post',
		    url 		: '/admin/update-subadmins-status',
		    data 		: {status:status,subadmins_id:subadmins_id},
		    success		: function(res){
		    	if (res['status'] == 0) {                
               		 $("#page-" + subadmins_id).html("<i class='fas fa-toggle-off' style='font-size:37px; color:white;' status='inactive'></i>");
                } else if (res['status'] == 1) {
	                $("#page-" + subadmins_id).html("<i class='fas fa-toggle-on' style='font-size:37px; color:green;' status='active'></i>");
	            }
		    }, 
		    error 		: function(xhr, status, error)
		    {
		    	 alert("Error: " + error);
		    }
        });
    });	

//Update Category Page Status 
$(document).on('click', '.updateCategoryStatus', function() {        
        var status = $(this).children('i').attr('status');

        var category_id = $(this).attr('id').split('-')[1];  

        $.ajax({
        	headers: {
		        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		    },
		    type 		:'post',
		    url 		: '/admin/update-category-status',
		    data 		: {status:status,category_id:category_id},
		    success		: function(res){
		    	if (res['status'] == 0) {                
               		 $("#page-" + category_id).html("<i class='fas fa-toggle-off' style='font-size:37px; color:white;' status='inactive'></i>");
                } else if (res['status'] == 1) {
	                $("#page-" + category_id).html("<i class='fas fa-toggle-on' style='font-size:37px; color:green;' status='active'></i>");
	            }
		    }, 
		    error 		: function(xhr, status, error)
		    {
		    	 alert("Error: " + error);
		    }
        });
    });	

//Update Product Page Status 
$(document).on('click', '.updateProductStatus', function() {        
        var status = $(this).children('i').attr('status');

        var product_id = $(this).attr('id').split('-')[1];  

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type        :'post',
            url         : '/admin/update-product-status',
            data        : {status:status,product_id:product_id},
            success     : function(res){
                if (res['status'] == 0) {                
                     $("#page-" + product_id).html("<i class='fas fa-toggle-off' style='font-size:37px; color:white;' status='inactive'></i>");
                } else if (res['status'] == 1) {
                    $("#page-" + product_id).html("<i class='fas fa-toggle-on' style='font-size:37px; color:green;' status='active'></i>");
                }
            }, 
            error       : function(xhr, status, error)
            {
                 alert("Error: " + error);
            }
        });
    }); 

//Update Product Attributes Page Status 
$(document).on('click', '.updateProductAttributeStatus', function() {        
        var status = $(this).children('i').attr('status');

        var productattr_id = $(this).attr('id').split('-')[1];  

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type        :'post',
            url         : '/admin/update-productattribute-status',
            data        : {status:status,productattr_id:productattr_id},
            success     : function(res){
                if (res['status'] == 0) {                
                     $("#page-" + productattr_id).html("<i class='fas fa-toggle-off' style='font-size:37px; color:white;' status='inactive'></i>");
                } else if (res['status'] == 1) {
                    $("#page-" + productattr_id).html("<i class='fas fa-toggle-on' style='font-size:37px; color:green;' status='active'></i>");
                }
            }, 
            error       : function(xhr, status, error)
            {
                 alert("Error: " + error);
            }
        });
    }); 

//Update Product Images Page Status 
$(document).on('click', '.updateProductImageeStatus', function() {        
        var status = $(this).children('i').attr('status');

        var productimg_id = $(this).attr('id').split('-')[1];  

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type        :'post',
            url         : '/admin/update-productimage-status',
            data        : {status:status,productimg_id:productimg_id},
            success     : function(res){
                if (res['status'] == 0) {                
                     $("#page-" + productimg_id).html("<i class='fas fa-toggle-off' style='font-size:37px; color:white;' status='inactive'></i>");
                } else if (res['status'] == 1) {
                    $("#page-" + productimg_id).html("<i class='fas fa-toggle-on' style='font-size:37px; color:green;' status='active'></i>");
                }
            }, 
            error       : function(xhr, status, error)
            {
                 alert("Error: " + error);
            }
        });
    }); 


//Update Brand Page Status 
$(document).on('click', '.updateBrandStatus', function() {        
        var status = $(this).children('i').attr('status');

        var brand_id = $(this).attr('id').split('-')[1];  

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type        :'post',
            url         : '/admin/update-brand-status',
            data        : {status:status,brand_id:brand_id},
            success     : function(res){
                if (res['status'] == 0) {                
                     $("#page-" + brand_id).html("<i class='fas fa-toggle-off' style='font-size:37px; color:white;' status='inactive'></i>");
                } else if (res['status'] == 1) {
                    $("#page-" + brand_id).html("<i class='fas fa-toggle-on' style='font-size:37px; color:green;' status='active'></i>");
                }
            }, 
            error       : function(xhr, status, error)
            {
                 alert("Error: " + error);
            }
        });
    }); 

//Update Banner Page Status 
$(document).on('click', '.updateBannerStatus', function() {        
        var status = $(this).children('i').attr('status');

        var banner_id = $(this).attr('id').split('-')[1];  

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type        :'post',
            url         : '/admin/update-banner-status',
            data        : {status:status,banner_id:banner_id},
            success     : function(res){
                if (res['status'] == 0) {                
                     $("#page-" + banner_id).html("<i class='fas fa-toggle-off' style='font-size:37px; color:white;' status='inactive'></i>");
                } else if (res['status'] == 1) {
                    $("#page-" + banner_id).html("<i class='fas fa-toggle-on' style='font-size:37px; color:green;' status='active'></i>");
                }
            }, 
            error       : function(xhr, status, error)
            {
                 alert("Error: " + error);
            }
        });
    }); 

//Update General Settings Status 
$(document).on('click', '.updateSettingStatus', function() {        
        var status = $(this).children('i').attr('status');

        var setting_id = $(this).attr('id').split('-')[1];  

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type        :'post',
            url         : '/admin/update-general-setting-status',
            data        : {status:status,setting_id:setting_id},
            success     : function(res){
                if (res['status'] == 0) {                
                     $("#page-" + setting_id).html("<i class='fas fa-toggle-off' style='font-size:37px; color:white;' status='inactive'></i>");
                } else if (res['status'] == 1) {
                    $("#page-" + setting_id).html("<i class='fas fa-toggle-on' style='font-size:37px; color:green;' status='active'></i>");
                }
            }, 
            error       : function(xhr, status, error)
            {
                 alert("Error: " + error);
            }
        });
    }); 


//Update DataList Status 
$(document).on('click', '.updateDataListStatus', function() {        
        var status = $(this).children('i').attr('status');

        var datalist_id = $(this).attr('id').split('-')[1];  

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type        :'post',
            url         : '/admin/update-data-list-status',
            data        : {status:status,datalist_id:datalist_id},
            success     : function(res){
                if (res['status'] == 0) {                
                     $("#page-" + datalist_id).html("<i class='fas fa-toggle-off' style='font-size:37px; color:white;' status='inactive'></i>");
                } else if (res['status'] == 1) {
                    $("#page-" + datalist_id).html("<i class='fas fa-toggle-on' style='font-size:37px; color:green;' status='active'></i>");
                }
            }, 
            error       : function(xhr, status, error)
            {
                 alert("Error: " + error);
            }
        });
    }); 



// Confirm the deletation of cms page 
	// $(document).on('click', '.confirmDelete', function() { 		
	// 	var name = $(this).attr('name');
	// 	if(confirm("Do you want to delete "+name+ " ?")){
	// 		return true;
	// 	}else{
	// 		return false;
	// 	}
	// });

// Confirm Deletion Information Page with sweetalert2
	$(document).on('click', '.confirmDelete', function() {
    var record_id = $(this).attr('recordid');
    
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: "Deleted!",
                text: "Your Information page has been deleted.",
                icon: "success"
            }).then(() => {
                window.location.href = "/admin/delete-info/" + record_id;
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Your Information page is safe :)",
                icon: "error"
            });
        }
    });
});


// Confirm Deletion Subdomains Page with sweetalert2
	$(document).on('click', '.confirmDeleteSubdomains', function() {
    var record_id = $(this).attr('recordid');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: "Deleted!",
                text: "Your Subdomains has been deleted.",
                icon: "success"
            }).then(() => {
                window.location.href = "/admin/delete-subadmins/" + record_id;
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Your Subdomains is safe :)",
                icon: "error"
            });
        }
    });
});

// Confirm Deletion Category with sweetalert2
	$(document).on('click', '.confirmCategoryDelete', function() {
    var record_id = $(this).attr('recordid');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: "Deleted!",
                text: "Your Category has been deleted.",
                icon: "success"
            }).then(() => {
                window.location.href = "/admin/delete-category/" + record_id;
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Your Category is safe :)",
                icon: "error"
            });
        }
    });
});

// Confirm Deletion Product with sweetalert2
    $(document).on('click', '.confirmProductDelete', function() {
    var record_id = $(this).attr('recordid');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: "Deleted!",
                text: "Your Product has been deleted.",
                icon: "success"
            }).then(() => {
                window.location.href = "/admin/delete-product/" + record_id;
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Your Product is safe :)",
                icon: "error"
            });
        }
    });
});


// Confirm Deletion Brand with sweetalert2
    $(document).on('click', '.confirmBrandDelete', function() {
    var record_id = $(this).attr('recordid');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: "Deleted!",
                text: "Your Brand has been deleted.",
                icon: "success"
            }).then(() => {
                window.location.href = "/admin/delete-brand/" + record_id;
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Your Brand is safe :)",
                icon: "error"
            });
        }
    });
});


// Confirm Deletion Setting with sweetalert2
    $(document).on('click', '.confirmGeneralDelete', function() {
    var record_id = $(this).attr('recordid');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: "Deleted!",
                text: "Your Setting has been deleted.",
                icon: "success"
            }).then(() => {
                window.location.href = "/admin/delete-general/" + record_id;
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Your Setting is safe :)",
                icon: "error"
            });
        }
    });
});

// Confirm Deletion Banner with sweetalert2
    $(document).on('click', '.confirmBannerDelete', function() {
    var record_id = $(this).attr('recordid');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: "Deleted!",
                text: "Your Banner has been deleted.",
                icon: "success"
            }).then(() => {
                window.location.href = "/admin/delete-banner/" + record_id;
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Your Banner is safe :)",
                icon: "error"
            });
        }
    });
});

// Confirm Deletion DataList with sweetalert2
    $(document).on('click', '.confirmDataListDelete', function() {
    var record_id = $(this).attr('recordid');

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },
        buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            swalWithBootstrapButtons.fire({
                title: "Deleted!",
                text: "Your DataList has been deleted.",
                icon: "success"
            }).then(() => {
                window.location.href = "/admin/delete-data-list/" + record_id;
            });
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            swalWithBootstrapButtons.fire({
                title: "Cancelled",
                text: "Your DataList is safe :)",
                icon: "error"
            });
        }
    });
});



// Descriptions Datatables
        $('#summernote').summernote({
            height: 300, 
            minHeight: null, 
            maxHeight: null, 
            focus: true,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],               
                ['insert', ['link', 'picture', 'video']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['height', ['height']],
                ['alignment', ['alignment']],
                ['view', ['fullscreen', 'codeview', 'help']],
            ]
        });

// Add Atrributes Scripts dynamacilly
    var maxField = 10; 
    var addButton = $('.add_button'); 
    var wrapper = $('.field_wrapper');
    var fieldHTML = '<div><input type="text" class="form-control" name="size[]" id="size" placeholder="Size">&nbsp;<input type="text" class="form-control" name="sku[]" id="sku" placeholder="SKU">&nbsp;<input type="text" class="form-control" name="price[]" id="price" placeholder="Price">&nbsp;<input type="text" class="form-control" name="stock[]" id="stock" placeholder="Stock">&nbsp; <a href="javascript:void(0);" class="remove_button btn btn-danger">Remove</a></div>'; 
    var x = 1;     
    
    $(addButton).click(function(){       
        if(x < maxField){ 
            x++;
            $(wrapper).append(fieldHTML); 
        }else{
            alert('A maximum of '+maxField+' fields are allowed to be added. ');
        }
    });    
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').remove();
        x--; 
    });


});
