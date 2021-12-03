let baseUrl = '../models/panierData/dataManagement.php'

export function validateCommand() {
    let commandItems = document.querySelectorAll('.validation')
    commandItems.forEach(element => {
        element.addEventListener('click', () => {
            let id = +element.getAttribute('id')
            let localData
            $.post(baseUrl, { commandIdForValidation: id }, (data) => {
                localData = data
            }).then(() => {
                if (localData.status) {
                    window.location.reload();
                    alert("La commande a été validé avec succès ,veiullez proceder à la livraision.")
                }
            })
        })
    });
}

export function unvalidateCommand() {
    let commandItems = document.querySelectorAll('.unvalidation')
    commandItems.forEach(element => {
        element.addEventListener('click', () => {
            let id = +element.getAttribute('id')
            let localData
            $.post(baseUrl, { unvalidateCommandId: id }, (data) => {
                localData = data
            }).then(() => {
                if (localData.status) {
                    window.location.reload();
                    alert("La commande a été restaurée avec succès.")
                }
            })
        })
    });
}



$(function() {

    validateCommand()
    unvalidateCommand()

})