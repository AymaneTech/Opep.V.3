let cartId = document.querySelectorAll("#addToCart");
let searchInput = document.querySelector("#searchInput");
let test = document.querySelector("#test");

function addToCart(plantId) {
    const option = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        // body: `plantId=${plantId}`,
    };

    fetch(`../../controllers/cartController.php?plantId=${plantId}`, option)
        .then((response) => {
            console.log(response);
        });
}
function filterByCategory(categoryId) {
    const xhr = new XMLHttpRequest();
    xhr.open('GET',`./?filterByCategory=${categoryId}`, true);
    xhr.onreadystatechange = () => {
        if (xhr.status === 200 && xhr.readyState === 4){
            console.log(categoryId);
            console.log(xhr.responseText);
            console.log("hani");
        }
    }
    xhr.send();
}


searchInput.addEventListener('keyup', function () {
    let url = './?search.php';
    const option = {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `searchValue=${searchInput.value}`,
    };

    fetch(url, option)
        .then((response) => {
            console.log(response);
        });
});

