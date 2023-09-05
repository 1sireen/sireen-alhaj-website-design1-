
function addToCart(productName, productPrice, productImage) {
 
    const item = {
        name: productName,
        price: productPrice,
        image: productImage
    };

    
    let cartItems = JSON.parse(localStorage.getItem('cart')) || [];
    cartItems.push(item);
    localStorage.setItem('cart', JSON.stringify(cartItems));

  
}


const buyButtons = document.querySelectorAll('.buy-button');


buyButtons.forEach(button => {
    button.addEventListener('click', () => {
        
        const productContainer = button.closest('.box');
        const productName = productContainer.querySelector('h2').textContent; 
        const productPrice = parseFloat(productContainer.querySelector('span').textContent.replace('$', ''));
        const productImage = productContainer.querySelector('img').src; 

       
        addToCart(productName, productPrice, productImage);
    });
});
