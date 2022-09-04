# COMP3421 Web Project
We are designed to build up an e-commerce website which is for computer parts shopping.

Important notice: this repository code is shared with "COMP3334_Web_Project_GP38".

## Overview
In this project, we are going to design an e-commerce website which is for computer parts shopping. Users visit the shopping website to browse for products, add products to the cart, and pay.

### On this website, we are choosing to apply to the following technologies:
* PHP
* MySQL
* HTML
* CSS
* JavaScript

### We expect to include the below functions on the website:
* Login and registration system
* View my account
* List all products
* List transaction records
* Create new items
* Shopping cart
* Payment system

## Designed page

The detailed page of the website will be shown as a table below:
<table>
    <thead>
        <tr>
            <th>Category</th>
            <th>Related page</th>
            <th>Function</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td rowspan=3>User Registration, Login and Logout</td>
            <td>sign_up.php</td>
            <td><ul><li>Registrar an account of the system</li><li>Common information: login id, nick name, email, password, birthday, and gender</li></ul></td>
        </tr>
        <tr>
            <td>login.php<br>authenticate.php</td>
            <td><ul><li>Use id or email and password to login</li><li>Remember login status using cookie</li></ul></td>
        </tr>
        <tr>
            <td>logout.php</td>
            <td>User logout (and delete cookie)</td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td>Product</td>
            <td>index.php</td>
            <td>This is the home page, and the user can:<ul><li>Choose product</li><li>Add product to cart</li><li>Order the product</li><li>Update shopping cart</li></ul></td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td rowspan=3>Admin</td>
            <td>create_product.php</td>
            <td>Admin can create product</td>
        </tr>
        <tr>
            <td>products_list.php</td>
            <td>Admin can view all products list</td>
        </tr>
        <tr>
            <td>sales_record.php</td>
            <td>Admin can view all the sell record</td>
        </tr>
    </tbody>
</table>

## Group Members
* [HKSSY](https://github.com/HKSSY)
* Roland MOK
* Sam KAN
* Peter YUK
