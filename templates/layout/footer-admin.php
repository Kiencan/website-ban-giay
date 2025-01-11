<?php
if (!defined('_CODE')) {
    die('Access denied');
}
?>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
<script>
    var table = $('#datatable').DataTable({
        layout: {
            topStart: {
                pageLength: {
                    menu: [5, 25, 50, 100]
                }
            }, // góc trái trên
            // topEnd: null, // góc pháp trên
            // bottomEnd: {
            //     paging: {
            //         type: 'simple_numbers' // chỉ có một nút next
            //     }
            // },  // góc phải dưới
            // bottomStart: {
            //     pageLength: {
            //         menu: [5, 25, 50, 100]
            //     }
            // } // góc trái dưới
        },
    });
</script>
<script>
    var table = $('#datatable1').DataTable({
        layout: {
            topStart: {
                pageLength: {
                    menu: [5, 25, 50, 100]
                }
            }, // góc trái trên
            // topEnd: null, // góc pháp trên
            // bottomEnd: {
            //     paging: {
            //         type: 'simple_numbers' // chỉ có một nút next
            //     }
            // },  // góc phải dưới
            // bottomStart: {
            //     pageLength: {
            //         menu: [5, 25, 50, 100]
            //     }
            // } // góc trái dưới
        },
    });
</script>
<script>
    var el = document.getElementById("wrapper");
    var toggleButton = document.getElementById("menu-toggle");

    toggleButton.onclick = function() {
        el.classList.toggle("toggled");
    };
</script>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result; // Gán đường dẫn ảnh vào thuộc tính src
                preview.style.display = 'block'; // Hiển thị ảnh
            };

            reader.readAsDataURL(input.files[0]); // Đọc tệp ảnh
        } else {
            preview.src = "#";
            preview.style.display = 'none';
        }
    }
</script>