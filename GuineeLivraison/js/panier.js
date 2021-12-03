let baseUrl = '../models/panierData/dataManagement.php'

export function loadPriceAndPanierCount() {
    let localData;
    $.get(baseUrl, { loadPriceAndCount: true }, (data) => {
        localData = data
    }).then(() => {
        let totalSpan = document.getElementById('cart-total')
        totalSpan.innerHTML = "( " + localData.price + " Fg)"

        let quantitySpan = document.getElementById('cart-quantity')
        quantitySpan.innerHTML = localData.count
    })
}

export function addProductToPanier() {
    $('.addProduct').on('click', function() {
        let id = $(this).attr('id')
        let localData
        $.post(baseUrl, { product_id: id }, (data) => {
            localData = data
        }).then(() => {
            alert(localData.success)
            loadPriceAndPanierCount()
        })
    })
}


export function search() {
    let searchBtn = document.getElementById('searchBtn')
    searchBtn.addEventListener('click', () => {
        let searchInput = document.getElementById('searchInput')
        let value = searchInput.value
        if (value.length > 0) {
            let status
            $.post(baseUrl, { search: value }, (data) => {
                status = data.status
            }).then(() => {
                if (status) document.location.href = '../views/recherche.php'
            })
        }
    })
}

export function searchRestaurant() {
    console.log("cocucou")
    let searchBtn = document.getElementById('searchListRestoBTN')
    searchBtn.addEventListener('click', () => {
        let searchInput = document.getElementById('searchInputRestoBTN')
        let value = searchInput.value
        if (value.length > 0) {
            let status
            $.post(baseUrl, { searchList: value }, (data) => {
                status = data.status
            }).then(() => {
                if (status) document.location.href = '../views/rechercheRestaurants.php'
            })
        }
    })
}

export function augmentPlatQuantity() {
    let platItems = document.querySelectorAll('.add')
    platItems.forEach(element => {
        element.addEventListener('click', () => {
            let id = +element.getAttribute('id')
            let status
            $.post(baseUrl, { add: id }, (data) => {
                status = data.status
            }).then(() => {
                if (status) window.location.reload();
            })
        })
    });
}

export function decreasePlatQuantity() {
    let platItems = document.querySelectorAll('.minus')
    platItems.forEach(element => {
        element.addEventListener('click', () => {
            let id = +element.getAttribute('id')
            let status
            $.post(baseUrl, { minus: id }, (data) => {
                status = data.status
            }).then(() => {
                if (status) window.location.reload();
            })
        })
    });
}

export function command() {
    let platItems = document.querySelectorAll('.command')
    platItems.forEach(element => {
        element.addEventListener('click', () => {
            let id = +element.getAttribute('id')
            let localData
            $.post(baseUrl, { command: id }, (data) => {
                localData = data
            }).then(() => {
                if (localData.status) {
                    window.location.reload();
                    alert("commande ajouté avec succès , nous vous contacterons dans peux pour la livraison.")
                } else {
                    alert("Veillez vous connecter pour passer une commande.")
                }
            })
        })
    });
}


$(function() {

    command()

    search()

    augmentPlatQuantity()

    decreasePlatQuantity()

    loadPriceAndPanierCount()

    addProductToPanier()

})