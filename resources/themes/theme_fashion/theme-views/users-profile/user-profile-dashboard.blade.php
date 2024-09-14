@extends('theme-views.layouts.app')

@section('title', translate('my_profile') . ' | ' . $web_config['name']->value . ' ' . translate('ecommerce'))

@section('content')
 
<div class="container">
    <div class="row">
        <!-- Left Sidebar Column -->
        <div class="col-md-3 sidebar-container">
            <div class="sidebar">
                <h4>Dashboard</h4>
                <div class="settings">
                    <h6>Settings</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Personal Information</a></li>
                        <li><a href="#">Contact Details</a></li>
                        <li><a href="#">My Payments</a></li>
                        <li><a href="#">Children Details</a></li>
                        <li><a href="#">Address Book</a></li>
                        <li><a href="#">Change Password</a></li>
                        <li><a href="#">Deactivated Account</a></li>
                    </ul>
                    <h6>Information</h6>
                    <ul class="list-unstyled">
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Return Policy</a></li>
                        <li><a href="#">Privacy Center</a></li>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                    <div class="sign-out">
                        <a href="#" class="btn btn-dark btn-block">Sign Out</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Middle User Info Column -->
        <div class="col-md-5 user-info-container">
            <div class="user-info">
                <div class="user-profile text-center">
                    <img src="path_to_user_image.jpg" class="user-image" alt="Profile Image">
                    <h3>Hello, Samira</h3>
                    <p>Welcome to Bachay.com</p>
                </div>
                <div class="features">
                    <ul class="list-inline">
                        <li><img src="public/assets/images/icons/wallet.png" alt="Wallet"> Rs. 140</li>
                        <li><img src="public/assets/images/icons/coupons.png" alt="Coupons"> 02</li>
                        <li><img src="public/assets/images/icons/points.png" alt="Points"> 200</li>
                        <li><img src="public/assets/images/icons/giftcards.png" alt="Gift Cards"> Gift Cards</li>
                    </ul>
                </div>
                <div class="orders mt-4">
                    <h6>My Orders</h6>
                    <ul class="list-inline">
                        <li><img src="public/assets/images/icons/history.png" alt="History"> History</li>
                        <li><img src="public/assets/images/icons/returns.png" alt="Returns"> Returns</li>
                        <li><img src="public/assets/images/icons/reorder.png" alt="Reorder"> Reorder</li>
                        <li><img src="public/assets/images/icons/tracking.png" alt="Tracking"> Tracking</li>
                        <li><img src="public/assets/images/icons/reviews.png" alt="Reviews"> Reviews</li>
                    </ul>
                </div>
                <div class="others mt-4">
                    <h6>Others</h6>
                    <ul class="list-inline">
                        <li><img src="public/assets/images/icons/favorites.png" alt="Favorites"> Favorites</li>
                        <li><img src="public/assets/images/icons/payment.png" alt="Payment"> Payment</li>
                        <li><img src="public/assets/images/icons/account.png" alt="Account"> Account</li>
                        <li><img src="public/assets/images/icons/children.png" alt="Children"> Children</li>
                        <li><img src="public/assets/images/icons/contact.png" alt="Contact"> Contact</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Right Column: Recent Orders and Views -->
        <div class="col-md-4 recent-container">
            <div class="recent-orders">
                <h6>Recent Ordered</h6>
                <div class="d-flex justify-content-between">
                    <div class="order-item text-center">
                        <img src="public/assets/images/products/product1.jpg" class="product-image img-fluid" alt="Product Image">
                        <p>Product Name</p>
                        <span class="price">Rs. 789</span>
                    </div>
                    <div class="order-item text-center">
                        <img src="public/assets/images/products/product2.jpg" class="product-image img-fluid" alt="Product Image">
                        <p>Product Name</p>
                        <span class="price">Rs. 789</span>
                    </div>
                </div>
            </div>
            <div class="recent-views mt-4">
                <h6>Recent View</h6>
                <div class="d-flex justify-content-between">
                    <div class="view-item text-center">
                        <img src="public/assets/images/products/product3.jpg" class="product-image img-fluid" alt="Product Image">
                        <p>Product Name</p>
                        <span class="price">Rs. 789</span>
                    </div>
                    <div class="view-item text-center">
                        <img src="public/assets/images/products/product4.jpg" class="product-image img-fluid" alt="Product Image">
                        <p>Product Name</p>
                        <span class="price">Rs. 789</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
body {
    font-family: 'Poppins', sans-serif;
}

.sidebar-container {
    background-color: #fff;
    padding: 25px;
    height: 100vh;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
}

.sidebar h4 {
    font-size: 1.5rem;
    font-weight: bold;
    margin-bottom: 20px;
}

.sidebar h6 {
    font-size: 1.2rem;
    margin-bottom: 15px;
}

.sidebar .list-unstyled li {
    font-size: 1rem;
    padding: 10px 0;
}

.sidebar .list-unstyled li a {
    color: #000;
    text-decoration: none;
}

.sidebar .btn {
    margin-top: 20px;
    background-color: #000;
    color: #fff;
}

.user-info-container {
    background-color: #fff;
    padding: 25px;
}

.user-profile img {
    border-radius: 50%;
    width: 100px;
    height: 100px;
}

.user-profile h3 {
    font-size: 1.8rem;
    font-weight: bold;
    margin-top: 15px;
}

.user-profile p {
    font-size: 1rem;
    color: #666;
}

.features ul {
    list-style-type: none;
    padding: 0;
}

.features ul li {
    display: inline-block;
    margin-right: 20px;
    font-size: 1rem;
}

.features ul li img {
    width: 30px;
    margin-right: 5px;
}

.recent-container {
    background-color: #fff;
    padding: 25px;
}

.order-item img, .view-item img {
    width: 100px;
    height: 100px;
    border-radius: 5px;
}

.order-item, .view-item {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 45%;
}

.order-item p, .view-item p {
    font-size: 1rem;
    margin-top: 10px;
}

.order-item .price, .view-item .price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #000;
}

</style>
@endsection
