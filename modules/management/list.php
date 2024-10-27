<?php
if (!defined('_CODE')) {
    die('Access denied');
}

$title = ['pageTitle' => 'Danh sách người dùng'];
layouts('header-login', $title);


if (!isLogin()) {
    redirect('?module=auth&action=login');
}

// Truy vấn vào bảng customer
$listUser = getRaw("SELECT * FROM customer ORDER BY update_at");
// echo '<pre>';
// print_r($listUser);
// echo '</pre>';

$smg = getFlashData('smg');
$smg_types = getFlashData('smg_types');
?>

<div class="container">
    <hr>
    <h2> Quản lý người dùng </h2>
    <p>
        <a href="?module=management&action=add" class="btn btn-success btn-sm">Thêm người dùng <i class="fa-solid fa-plus"></i></a>
    </p>
    <?php
    if (!empty($smg)) {
        getSmg($smg, $smg_types);
    }
    ?>
    <table class="table table-bordered">
        <thead>
            <th> STT </th>
            <th> Họ và tên </th>
            <th> Email </th>
            <th> Số điện thoại </th>
            <th> Trạng thái </th>
            <th width="5%"> Sửa </th>
            <th width="5%"> Xóa </th>
        </thead>
        <tbody>
            <?php
            if (!empty($listUser)):
                $count = 0;
                foreach ($listUser as $item):
                    $count++;
            ?>
                    <tr>
                        <td><?php echo $count ?></td>
                        <td><?php echo $item['fullname'] ?></td>
                        <td><?php echo $item['email'] ?></td>
                        <td><?php echo $item['phone'] ?></td>
                        <td><?php echo $item['status'] == 1 ? '<button class="btn btn-success"> Đã kích hoạt </button>' :
                                '<button class="btn btn-danger"> Chưa kích hoạt </button>'; ?></td>
                        <td><a href="<?php echo "?module=management&action=edit&id=" . $item['id'] ?>" class="btn btn-warning btn-sm"><i class="fa-solid fa-pen-to-square"></i></a></td>
                        <td><a href="<?php echo "?module=management&action=delete&id=" . $item['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')" class="btn btn-danger btn-sm">
                                <i class="fa-solid fa-trash"></i></a></td>
                    </tr>
                <?php
                endforeach;

            else:
                ?>
                <tr>
                    <td colspan="7">
                        <div class="alert alert-danger text-center">Không có người dùng nào!</div>
                    </td>
                </tr>
            <?php
            endif;
            ?>
        </tbody>
    </table>
</div>