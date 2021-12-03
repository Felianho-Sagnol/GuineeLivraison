let baseUrl = "GuineeLivraison/php/models/panierData/dataManagement.php"

export function loadPriceAndPanierCount() {
    let localData;
    $.get(baseUrl, { loadPriceAndCount: true }, (data) => {
        localData = data
    }).then(() => {
        let totalSpan = document.getElementById('cart-total')
        totalSpan.innerHTML = "( " + localData.price + " Fg)"

        let quantitySpan = document.getElementById('cart-quantity')
        quantitySpan.innerHTML = +localData.count
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
    if (searchBtn != null) {
        searchBtn.addEventListener('click', () => {
            let searchInput = document.getElementById('searchInput')
            let value = searchInput.value
            if (value.length > 0) {
                let status
                $.post(baseUrl, { search: value }, (data) => {
                    status = data.status
                }).then(() => {
                    if (status) document.location.href = 'GuineeLivraison/php/views/recherche.php';
                })
            }
        })
    }

}

export function searchRestaurant() {
    console.log("cocucou")
    let searchBtn = document.getElementById('searchListRestoBTN')
    if (searchBtn != null) {
        searchBtn.addEventListener('click', () => {
            let searchInput = document.getElementById('searchInputRestoBTN')
            let value = searchInput.value
            if (value.length > 0) {
                let status
                $.post(baseUrl, { searchList: value }, (data) => {
                    status = data.status
                }).then(() => {
                    if (status) document.location.href = 'GuineeLivraison/php/views/rechercheRestaurants.php'
                })
            }
        })
    }

}

$(function() {
    search()

    searchRestaurant()

    loadPriceAndPanierCount()

    addProductToPanier()
})