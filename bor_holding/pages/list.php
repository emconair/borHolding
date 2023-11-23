<div class="container">
    <div class="row mb-3">
        <div class="container">
            <form action="#" name="add-car" onsubmit="return false;">
                <div class="form-group">
                    <label for="car_name" class="form-control">Araç Adı:</label>
                    <input type="text" class="form-control" id="car_name" name="car_name" required>
                </div>
                <div class="form-group">
                    <label for="car_price" class="form-control">Fiyat:</label>
                    <input type="text" class="form-control" id="car_price" name="car_price" required>
                </div>
                <div class="form-group">
                    <label for="car_detail" class="form-control">Araç Detay:</label>
                    <input type="text" class="form-control" id="car_detail" name="car_detail" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Araç Ekle</button>
            </form>
        </div>
    </div>
    <div class="row">
        <?php
            $car_list = $app->getAllCarList();
            foreach ($car_list as $item) { ?>
                <div class="row mt-3 border align-items-center">
                    <div class="col">Araç Adı: <?=$item->car_name?></div>
                    <div class="col">Fiyat: <?=$item->car_price?></div>
                    <div class="col">Araç Detay: <?=$item->car_detail?></div>
                    <div class="col"><a href="javascript:void(0);" class="btn btn-warning" data-id="<?=$item->id?>" data-selector="update">Güncelle</a></div>
                    <div class="col"><a href="javascript:void(0);" class="btn btn-danger" data-id="<?=$item->id?>" data-selector="delete">Sil</a></div>
                </div>
        <?php } ?>
    </div>
</div>