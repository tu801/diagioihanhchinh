# Vietnameese Area Management

Quản lý danh sách các tỉnh thành tại Việt Nam, database sẽ update theo repo này:

> https://github.com/ThangLeQuoc/vietnamese-provinces-database

## Cấu trúc:

Database bao gồm 2 phần dữ liệu:

1. Các table dữ liệu chính theo repo trên

2. Các table có prefix là `tmt_` là các table chứa dữ liệu province | district | ward đã được convert ra để dùng cho các dự án khác

## Setup

- Copy `env` to `.env` và sửa thông tin dự án, database cho đúng

- Chạy migration để tạo các table chứa data sau khi convert

- import file [mysql](E:\laragon\www\diagioihanhchinh\app\Database\mysql\CreateTables_vn_units.sql) để import các table chứa dữ liệu chưa convert

- Chạy các lệnh sau để convert data:

```shell
php spark convert:province
php spark convert:district
php spark convert:ward
```

- Khi có data mới update thì copy file mysql data vào folder `app\Database\mysql` và đánh dấu version cho phù hợp đồng thời sửa biến `$dataFile` trong file `app\Database\Seeds\ImportNewData.php`. Sau đó chạy lệnh seed để seed data mới đồng thời xoá các data cũ

```shell
php spark db:seed ImportNewData
```

- Sau khi setup xong truy cập vào trang chủ và nhấn các nut export để xuất ra file json dùng cho các dự án khác
