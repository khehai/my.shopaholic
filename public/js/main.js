"use strict";

const navbarToggler = document.getElementById('navbar-toggler');

const modalWindow = document.querySelector(".modal");
const showCase = document.querySelector(".catalog");
const shoppingCartValue = document.getElementById('shopping-cart-value');
const wishListValue = document.getElementById('wish-list-value');
const shoppingCartItems = document.querySelector(".shopping-cart-items");
const categoriesList = document.querySelector(".categories-list");

let cart = [];
let wishlist = [];

class Store {
    static init(key) {
        
        if (!Store.isset(key)) Store.set(key, []);
        return Store.get(key);
    }

    static set(key, value) {
        return localStorage.setItem(key, JSON.stringify(value));
    }
    static get(key) {
        let value = localStorage.getItem(key);
        return value === null ? null : JSON.parse(value);
    }

    static isset(key) {
        return this.get(key) !== null;
    }
}

const clear = () => {
    cart = [];
    shoppingCartItems.innerHTML = '';
    saveCart(cart);
    amountCartItems(cart);
}


let productItemTemplate = product =>
    `<!-- PRODUCT-->
        <div class="col-lg-4 col-sm-6">
            <div class="product text-center">
                <div class="mb-3 position-relative">
                    <div class="badge text-white bg-${product.badgeTitle}">${product.badgeTitle}</div>
                    <a class="d-block" href="detail.html"><img class="img-fluid w-100" src="${product.image}" alt="${product.name}"></a>
                    <div class="product-overlay">
                        <ul class="mb-0 list-inline btn-block" data-id="${product.id}" data-price="${product.price}">
                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark add-to-wish-list" href="#!"><i class="far fa-heart"></i></a></li>
                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark add-to-cart" href="#!">Add to cart</a></li>
                            <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark detail" href="#productView" data-bs-toggle="modal"><i class="fas fa-expand"></i></a></li>
                        </ul>
                    </div>
                </div>
                <h6> <a class="reset-anchor" href="detail.html">${product.title}</a></h6>
                <p class="small text-muted">$${product.price}</p>
            </div>
        </div>
    `;

function cartItemTemplate(products, item) {
    // console.log('products =', products);
    let product = products.find(product => product.id == item.id);
    return ` <tr class="cart-item" id="id${product.id}">
    <th class="ps-0 py-3 border-light" scope="row">
      <div class="d-flex align-items-center"><a class="reset-anchor d-block animsition-link" href="detail.html"><img src="${product.image}" alt="${product.title}" width="70"></a>
        <div class="ms-3"><strong class="h6"><a class="reset-anchor animsition-link" href="detail.html">${product.title}</a></strong></div>
      </div>
    </th>
    <td class="p-3 align-middle border-light">
      <p class="mb-0 small">$${product.price}</p>
    </td>
    <td class="p-3 align-middle border-light">
      <div class="border d-flex align-items-center justify-content-between px-3"><span class="small text-uppercase text-gray headings-font-family">Quantity</span>
        <div class="quantity">
          <button class="dec-btn p-0" data-id="${product.id}"><i class="fas fa-caret-left"></i></button>
          <input class="form-control form-control-sm border-0 shadow-0 p-0 item-quantity" type="text" value="${item.amount}">
          <button class="inc-btn p-0" data-id="${product.id}"><i class="fas fa-caret-right"></i></button>
        </div>
      </div>
    </td>
    <td class="p-3 align-middle border-light">
      <p class="mb-0 small">$<span class="product-subtotal"></span></p>
    </td>
    <td class="p-3 align-middle border-light"><a class="reset-anchor trash" href="#!"><i class="fas fa-trash-alt small text-muted" data-id="${product.id}"></i></a></td>
  </tr>`;
}

function setCartTotal(cart) {
    let tmpTotal = 0;
    cart.map(item => {
        tmpTotal = item.price * item.amount;
        shoppingCartItems.querySelector(`#id${item.id} .product-subtotal`).textContent = parseFloat(tmpTotal.toFixed(2));    
    });

    document.querySelector('.cart-total').textContent = parseFloat(cart.reduce((previous, current) => previous + current.price * current.amount, 0).toFixed(2));
    
}


function amountCartItems(cart){
    if (cart) {
        shoppingCartValue.textContent = cart.reduce((prev, cur) => prev + cur.amount, 0);
    if(+shoppingCartValue.textContent > 0) {
        shoppingCartValue.classList.add('fw-bold');
        shoppingCartValue.style = "color:red;";
    }
  }
}

function saveWishList(wishlist){
    Store.set('wishlist', wishlist);
}

function addProductToWishList(product) {
    let inWishList = wishlist.some(element => element.id === product.id);

    if(!inWishList) wishlist = [...wishlist, product];
    saveWishList(wishlist);
    amountWishListItems(wishlist);
}


function amountWishListItems(wishlist){
    wishListValue.textContent = wishlist.length;
    if(+wishListValue.textContent > 0) {
        wishListValue.classList.add('fw-bold');
        wishListValue.style = "color:red;";
    }
}

function addToWishListButton() {
    let addToWishListButtons = document.querySelectorAll('.add-to-wish-list');
    addToWishListButtons.forEach((element) => {             
        element.addEventListener('click', (event) => {
            let productId = event.target.closest('.btn-block').dataset.id;
            let price = event.target.closest('.btn-block').dataset.price;
            addProductToWishList({id: productId, price:price});   
        });
    });    
}

const filterItem = (cart, id) => cart.filter(item => item.id != id);
const findItem = (cart, id) => cart.find(item => item.id == id);

function renderCart() {
    shoppingCartItems.addEventListener('click', event => {
        if(event.target.classList.contains('fa-trash-alt')) {           
            cart = filterItem(cart, event.target.dataset.id);
            setCartTotal(cart);
            saveCart(cart);
            amountCartItems(cart);
            event.target.closest('.cart-item').remove();
        } else if (event.target.classList.contains('inc-btn')){
            let tmpItem = findItem(cart, event.target.dataset.id);
            tmpItem.amount += 1;
            event.target.previousElementSibling.value = tmpItem.amount;
            setCartTotal(cart);
            saveCart(cart);
            amountCartItems(cart);
        }else if (event.target.classList.contains('dec-btn')){
            let tmpItem = findItem(cart, event.target.dataset.id);
            if(tmpItem !== undefined && tmpItem.amount > 1){
                tmpItem.amount -= 1;
                event.target.nextElementSibling.value = tmpItem.amount;
            }else{
                cart = filterItem(cart, event.target.dataset.id);
                event.target.closest('.cart-item').remove();
            }
            
            setCartTotal(cart);
            saveCart(cart);
            amountCartItems(cart);
        }
    })
}

function populateShoppingCart(products) {

    let res = "";
    cart.forEach(item => res+=cartItemTemplate(products, item));
    return res;
}

function populateProductList(products) {
    
    let content = "";

    for (let item of products) {
        content += productItemTemplate(item);
    }

    return content;
}

let rating = stars => {
    let result = "";

    for (let i=0; i<stars; i++) {
        result += '<li class="list-inline-item m-0"><i class="fas fa-star small text-warning"></i></li>';
    }

    for (let i=0; i<5-stars; i++) {
        result += '<li class="list-inline-item m-0"><i class="fas fa-star small"></i></li>';
    }
    return result;
}

let modalTemplate = product => `<div class="modal" id="productView" tabindex="-1">
<div class="modal-dialog">
  <div class="modal-content overflow-hidden border-0">
    <a href="#" class="p-4 close btn-close"><i class="fas fa-times"></i></a>
    
    <div class="modal-body p-0">
      <div class="row align-items-stretch">
        <div class="col-lg-6 p-lg-0">
          <div class="bg-center bg-cover d-block h-100" style="background: url(${product.image})">
          </div>
        </div>
        <div class="col-lg-6">
          <div class="p-4 my-md-4">
            <ul class="list-inline mb-2">
              ${rating(product.stars)}
            </ul>
            <h2 class="h4">${product.title}</h2>
            <p class="text-muted">$${product.price}</p>
            <p class="text-sm mb-4">${product.description}</p>
            <div class="row align-items-stretch mb-4 gx-0">
              <div class="col-sm-7">
                <div class="border d-flex align-items-center justify-content-between py-1 px-3"><span class="small text-uppercase text-gray mr-4 no-select">Quantity</span>
                  <div class="quantity btn-block" data-id="${product.id}" data-price="${product.price}">
                    <i class="fas fa-caret-left btn p-0 dec-btn"></i>
                    <input class="form-control border-0 shadow-0 p-0 quantity-result" type="text" value="1">
                    <i class="fas fa-caret-right btn p-0 inc-btn"></i>
                  </div>
                </div>
              </div>
              <div class="col-sm-5"><a class="btn btn-dark btn-sm w-100 h-100 d-flex align-items-center justify-content-center px-0 add-to-cart" href="#!"  data-id="${product.id}" data-price="${product.price}">Add to cart</a></div>
            </div><a class="btn btn-link text-dark text-decoration-none p-0" href="#!"><i class="far fa-heart me-2"></i>Add to wish list</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>`;


function renderModal() {

    modalWindow.querySelector('.inc-btn').addEventListener('click', event => {
        let val = event.target.previousElementSibling.value;
        
        val++;
        event.target.previousElementSibling.value = val;
    });

    modalWindow.querySelector('.dec-btn').addEventListener('click', event => {
        let val = event.target.nextElementSibling.value;
        if (val > 1) {
            val--;
        }
       
        event.target.nextElementSibling.value = val;
    });

    modalWindow.querySelector(".add-to-cart").addEventListener('click', event => {
        let productId = event.target.dataset.id;
        let price = event.target.dataset.price;
        addProductToCart({id:productId, price:price}, +modalWindow.querySelector(".quantity-result").value);
    });
}

function toggleModal(param, product={}) {
    if (modalWindow === null) {
        modalWindow.innerHTML = modalTemplate(product);
      
    } else {
        modalWindow.innerHTML = '';
    }
    modalWindow.style.display = param;
}

// showCase

function detailButton(products) {
    let detailButtons = showCase.querySelectorAll(".detail");
    detailButtons.forEach(button => {

        button.addEventListener('click', event => {
            let productId = event.target.closest('.btn-block').dataset.id;
            console.log(productId);
            let product = products.find(product => product.id == productId);
            toggleModal('block', product);

            modalWindow.innerHTML = modalTemplate(product);    
            renderModal();
            modalWindow.querySelector('.btn-close').addEventListener('click', event => {
                event.preventDefault();
                toggleModal('none');
            })
        });
    });
}

function saveCart(cart) {
    Store.set('basket', cart);
}

function addProductToCart(product, amount=1){
    let itemInCart = cart.some(element => element.id === product.id);
    if (itemInCart) {
        cart.forEach(item => {if(item.id === product.id) {
                item.amount += amount;
            }
        });
    }else{
        let cartItem = {...product, amount: amount};
        cart = [...cart, cartItem];
    }  
    saveCart(cart);
    amountCartItems(cart);
}

function addToCartButton(cart) {
    let addToCartButtons = document.querySelectorAll('.add-to-cart');
    addToCartButtons.forEach((element) => {
        element.addEventListener('click', (event) => {
            let productId = event.target.closest('.btn-block').dataset.id;
            let price = event.target.closest('.btn-block').dataset.price;

            addProductToCart({id: productId, price:price});
          
        });
    });
}


function distinctCategories(products) {
    let mapped = [...products.map(item => item.category)];
    const counts = {};
    mapped.forEach(function (x) { counts[x] = (counts[x] || 0) + 1; });
    return counts;
}


function categoryTemplate(category, count) {

    return `
    <li class="mb-2 d-flex justify-content-between">
    <a class="reset-anchor category-item" href="#!" data-category="${category.name}" data-category-id="${category.id}">${category.name}</a>   
    <span class="badge text-gray">${count}</span>
    </li>
    `;
}

function populateCategories(categories, products) {
    //document.querySelector(".all-categories").textContent = categories.length;
    let result = "";
    let disct = distinctCategories(products);
    
    categories.forEach(item => {
        let count = disct[item.name];
        result +=  categoryTemplate(item, count);});
    return result;
}

function renderCategory(selector, products) {
    
    const categoriesAll = document.querySelector(".categories");
    if (categoriesAll) {
        categoriesAll.addEventListener('click', () => { 
            
            showCase.innerHTML = populateProductList(products)
            addToCartButton(cart);
            detailButton(products);
            addToWishListButton(); 
        });
    }

    const categoryItems = document.querySelectorAll(selector);
    
    categoryItems.forEach(item => item.addEventListener('click', e => {
            e.preventDefault();

            if (e.target.classList.contains('category-item')) {
                const category = e.target.dataset.category;
                console.log(category)
                const categoryFilter = items => items.filter(item => item.category.includes(category));
                showCase.innerHTML = populateProductList(categoryFilter(products));

            }else{
                showCase.innerHTML = populateProductList(products);
            }
            addToCartButton(cart);
            detailButton(products);
            addToWishListButton(); 
        })
     ); 
  }

const carouselItemTemolate = data => `<div class="slide carousel-item">
<a class="category-item" href="#!" data-category="${data.name}">
<img src="${data.cover}" alt="" />
<strong class="category-item category-item-title" data-category="${data.name}">${data.name}</strong>
</a>
</div>`;

function makeCarousel(items) {
    let res = "";
    items.forEach(item => res += carouselItemTemolate(item));
    res += res;
    document.querySelector('.slide-track').innerHTML = res;
}

let compare = (key, order='asc') => (a, b) => {
    if (!a.hasOwnProperty(key) || !b.hasOwnProperty(key)) return 0;
    const A = (typeof a[key] === 'string') ? a[key].toUpperCase() : a[key];
    const B = (typeof b[key] === 'string') ? b[key].toUpperCase() : b[key]
    let comparison = 0;
    comparison = (A > B) ? 1 : -1;
    return (order === 'desc') ? -comparison : comparison;
}

// =======================================================

function fetchProducts(url){
    return fetch(url, {
        method: 'GET',
        headers: {'Content-Type': 'application/json'}
    }).then(response => {
        if(response.status >= 400){
            return response.json().then(err => {
                const error = new Error('Something went wrong!')
                error.data = err
                throw error
            })
        }
        return response.json();
    })
}

function fetchCategories(){
        return fetch('http://my.shopaholic/api/categories', {
            method: 'GET',
            headers: {'Content-Type': 'application/json'}
        }).then(response => {
            if(response.status >= 400){
                return response.json().then(err => {
                    const error = new Error('Something went wrong!')
                    error.data = err
                    throw error
                })
            }
            return response.json()
        })
    }

function isAuth() {
    return fetch('http://my.shopaholic/api/auth', {
            method: 'GET',
            headers: {'Content-Type': 'application/json'}
        })
    .then(response => {
        return response.json()
    })
}

// =======================================================
document.addEventListener("DOMContentLoaded", () => {
    // console.log(navbarToggler)
 
    navbarToggler.addEventListener('click', function(){
        document.querySelector('.collapse').classList.toggle('show');
    });

    cart = Store.init('basket');
    wishlist = Store.init('wishlist');
    amountCartItems(cart);
    amountWishListItems(wishlist);

    fetchProducts('http://my.shopaholic/api/products')
    .then(products => {

        let currentProducts = products;

        const filteredCurrentProduct = (value) => {
                currentProducts = products.filter(product => product.badgeTitle.includes(value));
                return currentProducts;
        };

 
        fetchCategories().then(categories => {

            if (document.querySelector(".carousel")) {
                makeCarousel(categories);
                renderCategory('.carousel-item', products);
            }
            
            if (categoriesList) {
                categoriesList.innerHTML = populateCategories(categories, products);
                renderCategory(".categories-list", products);
            }    
        
            const showOnly = document.querySelector(".show-only");

            if (showOnly) {
                let badges = [...new Set([...products.map(item => item.badgeTitle)].filter(item => item != ''))];

                showOnly.innerHTML = badges.map(item => `<div class="form-check mb-1">
                    <input class="form-check-input" type="checkbox" id="id-${item}" value="${item}" name="badge">
                    <label class="form-check-label" for="id-${item}">${item}</label>
                  </div>`).join(" ");

                let checkboxes = document.querySelectorAll('input[name="badge"]')

                let values = [];
                checkboxes.forEach(item => {
                    item.addEventListener("change", e => {
                        if (e.target.checked) {
                            values.push(item.value)
                            showCase.innerHTML = values.map(value => populateProductList(filteredCurrentProduct(value))).join("");
                        }else {
                            if (values.length != 0) {
                                let index = values.indexOf(item.value);
                                
                                if (index !== -1) {
                                    values.splice(index, 1);
                                }
                                
                                showCase.innerHTML = values.map(value => populateProductList(filteredCurrentProduct(value))).join("");
                            }
                        }
                        if (values.length == 0){
                            currentProducts = products;
                            showCase.innerHTML = populateProductList(products);    
                        }
                    })
                });
            }
        
            if(showCase) {
                showCase.innerHTML = populateProductList(products);
                addToCartButton(cart);
                detailButton(products);
                addToWishListButton();

                const selectPicker = document.querySelector('.selectpicker');
            if (selectPicker) {

                const sortingOrders = [
                        {k: "default", v: "Default Sorting"},
                        {k: "popularity", v: "Popularity Product"},
                        {k: "low-high", v: "Low To High Price"},
                        {k: "high-low", v: "High To Low Price"},
                ]

                selectPicker.innerHTML = sortingOrders.map(item => `<option value="${item.k}">${item.v}</option>`).join(" ");

                selectPicker.addEventListener('change' , function() {
                        switch(this.value){
                            case 'low-high':
                                showCase.innerHTML = populateProductList(currentProducts.sort(compare('price', 'asc')));
                                break;
                            case 'high-low':
                                showCase.innerHTML = populateProductList(currentProducts.sort(compare('price', 'desc')));
                                break;
                            case 'popularity':
                                showCase.innerHTML = populateProductList(currentProducts.sort(compare('stars', 'desc')));
                                break;
                            default: 
                                showCase.innerHTML = populateProductList(currentProducts.sort(compare('id', 'asc')));
                        }
                });
            }
            }
            
           
            if (shoppingCartItems) {
                shoppingCartItems.innerHTML = populateShoppingCart(products);
                setCartTotal(cart);
                renderCart();

                isAuth().then(auth => {
                    if(auth){
                        document.querySelector('.checkout').classList.add('is-active');    
                        document.querySelector("#checkout").addEventListener("click", () => {

                            let inCart = [];

                            Store.get("basket").forEach(item => {
                                inCart.push({
                                    id: parseInt(item.id),
                                    amount: parseInt(item.amount)
                                });
                            });

                            fetch("/api/checkout", {
                                method: "POST", // *GET, POST, PUT, DELETE, etc.
                                headers: {
                                    "Content-Type": "application/json"
                                },
                                body: JSON.stringify({
                                    cart: inCart,
                                })
                            })
                            .then((response) => {
                                console.log(response);
                                clear();
                                document.location.replace("/profile");
                            })
                            .catch((error) => {
                                console.log(error);
                            });

                        });
                        
                    }
                            
                });
            }
        
    }); // end fetch categories
  }); // end fetch products
});