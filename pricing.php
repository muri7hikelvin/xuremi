<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pricing Plans</title>
  
    <link href="https://fonts.googleapis.com/css2?family=Amarante&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #000000;
            
            
        } 
        /* MAIN CONTAINER */
.main {
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #131419;
    box-shadow: 8px 8px 15px #0e0f13, -8px -8px 15px #17181d;
    border-radius: 20px;
    margin: 20px;
   
}

/* NEUMORPHIC NAVBAR */
.navbar {
    width: 100%;
    height: 75px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 20px;
}

/* LOGO */
.logo {
    color: #FFFFFF;
    font-size: 35px;
    font-family: 'Amarante', cursive;
   
}
.logo-image {
    height: 50px; /* Adjust height as needed */
    width: auto; /* Maintain aspect ratio */
    margin-right: 15px; /* Space between logo and text */
}

/* MENU */
.menu {
    display: flex;
    align-items: center;
    
}

.menu ul {
    display: flex;
    justify-content: space-around;
    width: 100%;
    align-items: center;
}

.menu ul li {
    list-style: none;
    margin: 0 20px;
   
}

.menu ul li a {
    text-decoration: none;
    color: #FBFFFF;
    font-family: Arial, Helvetica, sans-serif;
    font-weight: bold;
    font-size: 14px;
    transition: 0.4s ease-in-out;
    
}

.menu ul li a:hover {
    color:  #F08080;
}

/* NEUMORPHIC SEARCH BAR */
.search {
    position: relative;
    display: flex;
    align-items: center;
}

.search__input {
    width: 250px;
    height: 40px;
    border: none;
    border-radius: 20px;
    padding-left: 50px;
    background-color: #131419;
    box-shadow: inset 8px 8px 15px #0e0f13, inset -8px -8px 15px #17181d;
    color: #FBFFFF;
    font-size: 14px;
}

.search__input::placeholder {
    color: #aaaaaa;
}

.search__icon {
    position: absolute;
    left: 15px;
    color: #aaaaaa;
    font-size: 20px;
}

/* HAMBURGER MENU */
.hamburger {
    display: none;
    font-size: 30px;
    color: #FBFFFF;
    cursor: pointer;
}

/* DROPDOWN EFFECT FOR MENU */
.menu ul {
    transition: max-height 0.3s ease;
}

.menu ul.collapsed {
    max-height: 0;
    overflow: hidden;
    display: none;
    position: fixed;
}

.menu ul.expanded {
    max-height: 500px;
    display: flex;
    flex-direction: column;
    background-color: #131419;
    border-radius: 20px;
    box-shadow: 8px 8px 15px #0e0f13, -8px -8px 15px #17181d;
    position: absolute;
    top: 75px;
    right: 20px;
    width: 250px;
}

        .pricing {
            list-style-type: none;
            padding: 0;
            margin: 20px auto;
            background-color: white;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            width: 300px;
            height: 650px;
            margin-top: 8%;
             
            
        }

        .pricing:hover {
            transform: translateY(-10px);
        }

        .pricing li {
            padding: 20px;
        }

        .pricing li:first-child {
            background-color: #f4f4f4;
        }

        .pricing li img {
            width: 80px;
            margin-bottom: 10px;
        }

        .pricing big {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .pricing h3 {
            font-size: 2rem;
            margin: 10px 0;
        }

        .pricing span {
            color: #888;
            font-size: 1rem;
        }

        .pricing button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
            
        }

        .pricing button:hover {
            background-color: #2980b9;
        }
  

        .pricing-row{
            gap: 50px;
        }
        /* Colors for different pricing cards */
        .p-green li:first-child { background-color: #2ecc71; }
        .p-yel li:first-child { background-color: #f1c40f; }
        .p-red li:first-child { background-color: #e74c3c; }
        .p-blue li:first-child { background-color: #3498db; }

        .p-green big, .p-yel big, .p-red big, .p-blue big {
            color: white;
        }

        /* Responsive Design */
        @media (min-width: 768px) {
            .pricing {
                max-width: 280px; /* Adjust the width to make sure cards are aligned horizontally on large screens */
                margin: 0;
            
            }

            .pricing-row {
                display: flex;
                justify-content: space-around;
                flex-wrap: nowrap;
                display: flex;
                justify-content: space-between; /* Reduce spacing between the cards */
                gap: 20px; /* Set a consistent gap between cards */
                flex-wrap: wrap; /* Allow cards to wrap if necessary */
            }
        }

        @media (max-width: 768px) {
            .pricing-row {
                display: block;
            }

            .pricing {
                margin: 0 auto 30px auto; /* Center the pricing cards on mobile */
            }
        }
.lmbtn{
    background-color: #4CAF50;
    padding: 10px 20px;
    align-items: center;    
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-left: 47.3%;
    

}
.lmbtn:hover{
    background-color: #3e8e41;
}


 /* Your existing CSS */
 @media (max-width: 768px) {
    .navbar ul {
        display: none; /* Hide the menu items */
    }
    .hamburger {
        display: block; /* Show the hamburger icon */
    }
}

.menu.expanded ul {
    display: flex; /* Show the menu items when expanded */
    flex-direction: column; /* Stack the items vertically */
}

       
    </style>
   
</head>
<body>

    <div class="main">
        <div class="navbar">
            <div class="icon">
                <h2 class="logo">xuremi</h2>
            </div>
            <div class="menu" id="menu">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="customercompany.php">PRODUCTS</a></li>
                    <li><a href="About.html">ABOUT</a></li>
                    <li><a href="news.php">NEWS</a></li>
                    <li><a href="#">REVIEWS</a></li>
                    <li class="search-menu-item">
                        <div class="search">
                            <input type="text" class="search__input" placeholder="Search...">
                            <div class="search__icon">
                                <ion-icon name="search"></ion-icon>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="hamburger" id="hamburger">
                <ion-icon name="menu-outline"></ion-icon>
            </div>
        </div>
    </div>
    
    <section class="container">
        <div class="pricing-row">
            <!-- Plan 1: Start -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <ul class="pricing p-green">
                    <li><big>Start</big></li>
                    <li>Lower and Middle School Applications</li>
                    <li>Web Portfolios</li>
                    <li>Blog Pages</li>
                    <li>Mini Web Apps</li>
                    <li>Single Function AI</li>
                    <li>
                        <h3>$399</h3>
                        <span>per year</span>
                    </li>
                    <li>
                        <div id="paypal-button-container-start">
                            <a href="checkout.php?plan=Start&price=399">  <button>Order Now</button></a>
                            
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Plan 2: Good -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <ul class="pricing p-yel">
                    <li><big>Good</big></li>
                    <li>Start Up Websites</li>
                    <li>Medium Web Apps</li>
                    <li>Multi functionality AI</li>
                    <li>E-Commerce Websites</li>
                    <li>
                        <h3>$899</h3>
                        <span>per year</span>
                    </li>
                    <li>
                        <div id="paypal-button-container-good">
                            <a href="checkout.php?plan=good&price=899">  <button>Order Now</button></a>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Plan 3: Ultima -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <ul class="pricing p-red">
                    <li><big>Ultima</big></li>
                    <li>Higher learning Websites</li>
                    <li>Hotel Management Systems</li>
                    <li>E-Commerce Websites and Apps</li>
                    <li>Enterprise level AI</li>
                    <li>Bus and Car Reservation Systems</li>
                    <li>
                        <h3>$2499</h3>
                        <span>per year</span>
                    </li>
                    <li>
                        <div id="paypal-button-container-ultima">
                            <a href="checkout.php?plan=ultima&price=2499">  <button>Order Now</button></a>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Plan 4: VIP -->
            <div class="col-xs-12 col-sm-6 col-md-3">
                <ul class="pricing p-blue">
                    <li><big>Vip</big></li>
                    <li>Companies and Corporations Systems</li>
                    <li>Bank management Systems</li>
                    <li>Government and Public Sector Systems</li>
                    <li>Airport and Railway Management Systems</li>
                    <li>
                        <h3>$4999</h3>
                        <span>Base price per year</span>
                    </li>
                    <li>
                        <div id="paypal-button-container-vip">
                            <a href="user_messages.php">  <button>Lets Talk</button></a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </section>

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // PayPal Button for Start Plan
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: { value: '399' }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Transaction completed by ' + details.payer.name.given_name);
                        window.location.href = 'moneytest.html'; // Redirect after transaction
                    });
                }
            }).render('#paypal-button-container-start');

            // PayPal Button for Good Plan
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: { value: '899' }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Transaction completed by ' + details.payer.name.given_name);
                        window.location.href = 'checkout.html?plan=good'; // Redirect after transaction
                    });
                }
            }).render('#paypal-button-container-good');

            // PayPal Button for Ultima Plan
            paypal.Buttons({
                createOrder: function(data, actions) {
                    return actions.order.create({
                        purchase_units: [{
                            amount: { value: '2499' }
                        }]
                    });
                },
                onApprove: function(data, actions) {
                    return actions.order.capture().then(function(details) {
                        alert('Transaction completed by ' + details.payer.name.given_name);
                        window.location.href = 'checkout.html?plan=ultima'; // Redirect after transaction
                    });
                }
            }).render('#paypal-button-container-ultima');

            // VIP Plan
            document.getElementById('vipButton').addEventListener('click', function() {
                alert('Let\'s talk!'); // Custom action for VIP plan
            });
        });
    </script>
</body>
</html>