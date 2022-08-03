// add to cart
document.querySelectorAll(".add_to_cart_button").forEach((element, index) => {
    element.onclick = function() {
        let productId = this.id;
        console.dir(this.id);

        $.ajax({
            url: '/cart/add_to_cart',
            data: {
                productId
            },
            method: 'POST',
        }).done((result) => {
            let data = JSON.parse(result.replace('<!--  -->', "").trim());
            let tagA = `<a href="/cart" class="added_to_cart wc-forward" title="Xem giỏ hàng">Xem giỏ hàng</a>`
            console.log(data);
            if (data.logged == false) {
                window.location = "user/login";
            } else {
                console.log(this.parentElement.querySelector('.link-cart'))
                this.parentElement.querySelector('.link-cart').innerHTML = tagA;
            }
        })
    }
})