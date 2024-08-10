# Database Design System
![DB Design System](image-2.png)


## Authentication
***
### Register
![alt text](image-1.png)

````json
[POST] /register
````

| Request | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Required**. Email must be valid and unique. |
| `password` | `string` | **Required**. Password must be at least 6 characters. |

### Response
````json
{
    "status": "success",
    "message": "Register user successfully",
    "data": {
        "user": {
            "email": "tokoweb@gmail.com",
            "updated_at": "2024-08-10T00:38:25.000000Z",
            "created_at": "2024-08-10T00:38:25.000000Z",
            "id": 10
        },
        "access_token": {
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvcmVnaXN0ZXIiLCJpYXQiOjE3MjMyNTAzMDUsImV4cCI6MTcyMzI1MzkwNSwibmJmIjoxNzIzMjUwMzA1LCJqdGkiOiJidHpNMDF5S3lURUFUa3BlIiwic3ViIjoiMTAiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.-snwxLimUnKQdhAaJ70N3AmqaAPr_MPpR73aHwrjgGU",
            "type": "Bearer",
            "expires_in": 3600
        }
    }
}
````

### Login

![alt text](image.png)

````json
[POST] /login
````

| Request | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `email` | `string` | **Required**. Email must be valid. |
| `password` | `string` | **Required**. Password must be at least 6 characters. |

### Response
````json
{
    "status": "success",
    "message": "Login successfully",
    "data": {
        "user": {
            "id": 10,
            "email": "tokoweb@gmail.com",
            "created_at": "2024-08-10T00:38:25.000000Z",
            "updated_at": "2024-08-10T00:38:25.000000Z"
        },
        "access_token": {
            "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvbG9naW4iLCJpYXQiOjE3MjMyNTA0NTgsImV4cCI6MTcyMzI1NDA1OCwibmJmIjoxNzIzMjUwNDU4LCJqdGkiOiJRUGNmOXJ3bVNTWGhWUmpHIiwic3ViIjoiMTAiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.1EKAzNl6XVyUPTRRTSWvA0PFTmDHEJpBIAPCS4DiY_M",
            "type": "Bearer",
            "expires_in": 3600
        }
    }
}
````

## NOTE: The Endpoint Bellow Requires Bearer Token
![alt text](image-3.png)

## Category Product
***
### Create
#### Authenticad Token Required
````json
[POST] /category-products
````
![alt text](image-4.png)

| Request | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. Name must be unique. |

### Response
````json
{
    "status": "success",
    "message": "Category Product created successfully",
    "data": {
        "name": "Mainan",
        "updated_at": "2024-08-10T00:47:28.000000Z",
        "created_at": "2024-08-10T00:47:28.000000Z",
        "id": 6
    }
}
````

### Update
#### Authenticad Token Required
````json
[PUT] /category-products/{id}
````
![alt text](image-5.png)

| Request | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. Name must be unique. |

### Response
````json
{
    "status": "success",
    "message": "Category Product updated successfully",
    "data": {
        "id": 6,
        "name": "Mainan Tembak Tembakan",
        "created_at": "2024-08-10T00:47:28.000000Z",
        "updated_at": "2024-08-10T00:50:28.000000Z"
    }
}
````


### Get All
#### Authenticad Token Required
````json
[GET] /category-products
````
![alt text](image-6.png)

### Response
````json
{
    "status": "success",
    "message": "Category Product found",
    "data": [
        {
            "id": 1,
            "name": "Makanan",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z"
        },
        {
            "id": 2,
            "name": "Minuman",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z"
        },
        {
            "id": 3,
            "name": "Elektronik",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z"
        },
        {
            "id": 4,
            "name": "Kesehatan",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z"
        },
        {
            "id": 5,
            "name": "Fashion",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z"
        },
        {
            "id": 6,
            "name": "Mainan Tembak Tembakan",
            "created_at": "2024-08-10T00:47:28.000000Z",
            "updated_at": "2024-08-10T00:50:28.000000Z"
        }
    ]
}
````

### Get One By ID
#### Authenticad Token Required
````json
[GET] /category-products/{id}
````
![alt text](image-7.png)

### Response
````json
{
    "status": "success",
    "message": "Category Product found",
    "data": {
        "id": 6,
        "name": "Mainan Tembak Tembakan",
        "created_at": "2024-08-10T00:47:28.000000Z",
        "updated_at": "2024-08-10T00:50:28.000000Z"
    }
}
````

### Delete By ID
#### Authenticad Token Required
````json
[DELETE] /category-products/{id}
````
![alt text](image-8.png)
### Response
````json
{
    "status": "success",
    "message": "Category Product deleted successfully!"
}
````

### If Category Product Was Not Found
![alt text](image-11.png)
![alt text](image-10.png)
![alt text](image-9.png)

### If Request Is Not Valid
![alt text](image-12.png)
![alt text](image-13.png)


***

## 3. Product
***
Symbolic Link Command:
````cli
php artisan storage:link
````

### Create
#### Authenticad Token Required
````json
[POST] /products
````
![alt text](image-14.png)

Product image will be stored in public/storage/products
![alt text](image-21.png)

| Request | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. Name product. |
| `price` | `integer` | **Required**. Price product, min 0. |
| `image` | `string` | **Required**. Image product. |
| `product_category_id` | `integer` | Category product. |

### Response
````json
{
    "status": "success",
    "message": "Product created successfully",
    "data": {
        "id": 6,
        "product_category_id": 3,
        "name": "Laptop Gaming Kenceng",
        "price": 10000000,
        "image": "products/laptop-gaming-kenceng-1723252092.jpg",
        "created_at": "2024-08-10T01:08:12.000000Z",
        "updated_at": "2024-08-10T01:08:12.000000Z",
        "category": {
            "id": 3,
            "name": "Elektronik",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z"
        }
    }
}
````

### Update
#### Authenticad Token Required
````json
[PUT] /products/{id}?_method=PUT
````
![alt text](image-15.png)
If product image has changed, the old image will be remove from folder and new image will be stored
![alt text](image-18.png)



| Request | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `name` | `string` | **Required**. Name product. |
| `price` | `integer` | **Required**. Price product, min 0. |
| `image` | `string` | Image product. |
| `product_category_id` | `integer` | Category product. |

### Response
````json
{
    "status": "success",
    "message": "Product updated successfully",
    "data": {
        "id": 6,
        "product_category_id": "3",
        "name": "Laptop ASUS TUF Gaming Kenceng Banget",
        "price": "11000000",
        "image": "products/laptop-asus-tuf-gaming-kenceng-banget-1723252269.jpg",
        "created_at": "2024-08-10T01:08:12.000000Z",
        "updated_at": "2024-08-10T01:11:09.000000Z",
        "category": {
            "id": 3,
            "name": "Elektronik",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z"
        }
    }
}
````


### Get All
#### Authenticad Token Required
````json
[GET] /products
````
![alt text](image-16.png)

### Response
````json
{
    "status": "success",
    "message": "Product found",
    "data": [
        {
            "id": 1,
            "product_category_id": 1,
            "name": "Nasi Goreng",
            "price": 10000,
            "image": "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z",
            "category": {
                "id": 1,
                "name": "Makanan",
                "created_at": "2024-08-10T00:33:27.000000Z",
                "updated_at": "2024-08-10T00:33:27.000000Z"
            }
        },
        {
            "id": 2,
            "product_category_id": 2,
            "name": "Es Teh",
            "price": 5000,
            "image": "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z",
            "category": {
                "id": 2,
                "name": "Minuman",
                "created_at": "2024-08-10T00:33:27.000000Z",
                "updated_at": "2024-08-10T00:33:27.000000Z"
            }
        },
        {
            "id": 3,
            "product_category_id": 3,
            "name": "Laptop Lenovo Thinkpad T495",
            "price": 4500000,
            "image": "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z",
            "category": {
                "id": 3,
                "name": "Elektronik",
                "created_at": "2024-08-10T00:33:27.000000Z",
                "updated_at": "2024-08-10T00:33:27.000000Z"
            }
        },
        {
            "id": 4,
            "product_category_id": 4,
            "name": "Paramex Obat Sakit Kepala",
            "price": 7000,
            "image": "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z",
            "category": {
                "id": 4,
                "name": "Kesehatan",
                "created_at": "2024-08-10T00:33:27.000000Z",
                "updated_at": "2024-08-10T00:33:27.000000Z"
            }
        },
        {
            "id": 5,
            "product_category_id": 5,
            "name": "Erigo Varsity",
            "price": 250000,
            "image": "https://images.unsplash.com/photo-1565299624946-b28f40a0ae38?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z",
            "category": {
                "id": 5,
                "name": "Fashion",
                "created_at": "2024-08-10T00:33:27.000000Z",
                "updated_at": "2024-08-10T00:33:27.000000Z"
            }
        },
        {
            "id": 6,
            "product_category_id": 3,
            "name": "Laptop ASUS TUF Gaming Kenceng Banget",
            "price": 11000000,
            "image": "products/laptop-asus-tuf-gaming-kenceng-banget-1723252269.jpg",
            "created_at": "2024-08-10T01:08:12.000000Z",
            "updated_at": "2024-08-10T01:11:09.000000Z",
            "category": {
                "id": 3,
                "name": "Elektronik",
                "created_at": "2024-08-10T00:33:27.000000Z",
                "updated_at": "2024-08-10T00:33:27.000000Z"
            }
        }
    ]
}
````

### Get One By ID
#### Authenticad Token Required
````json
[GET] /products/{id}
````
![alt text](image-17.png)


### Response
````json
{
    "status": "success",
    "message": "Product found",
    "data": {
        "id": 6,
        "product_category_id": 3,
        "name": "Laptop ASUS TUF Gaming Kenceng Banget",
        "price": 11000000,
        "image": "products/laptop-asus-tuf-gaming-kenceng-banget-1723252269.jpg",
        "created_at": "2024-08-10T01:08:12.000000Z",
        "updated_at": "2024-08-10T01:11:09.000000Z",
        "category": {
            "id": 3,
            "name": "Elektronik",
            "created_at": "2024-08-10T00:33:27.000000Z",
            "updated_at": "2024-08-10T00:33:27.000000Z"
        }
    }
}
````

### Delete By ID
#### Authenticad Token Required
````json
[DELETE] /products/{id}
````
![alt text](image-19.png)

After product success to delete, the image of product will be removed from folder
![alt text](image-20.png)

### Response
````json
{
    "status": "success",
    "message": "Product deleted successfully!"
}
````

### Image Product Was Stored In public/storage/products Folder
Symbolic link command:
````cli
php artisan storage:link
````
![alt text](image-18.png)

### If Product Was Not Found
![alt text](image-23.png)
![alt text](image-22.png)
![alt text](image-24.png)

### If Request Is Not Valid
![alt text](image-25.png)
![alt text](image-26.png)
