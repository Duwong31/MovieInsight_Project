const searchInput = document.getElementById('searchInput');
const clearIcon = document.getElementById('clearIcon');

// Show clear icon when typing
searchInput.addEventListener('input', function() {
    if (this.value.length > 0) {
        clearIcon.style.display = 'block';
    } else {
        clearIcon.style.display = 'none';
    }
});

// Clear phần tìm kiếm
clearIcon.addEventListener('click', function() {
    searchInput.value = '';
    clearIcon.style.display = 'none';
    searchInput.focus();
});
//Movies
const productContainers = [...document.querySelectorAll('.product-container')];
const nxtBtn = [...document.querySelectorAll('.nxt-btn')];
const preBtn = [...document.querySelectorAll('.pre-btn')];

productContainers.forEach((item, i) => {
    let containerDimensions = item.getBoundingClientRect();
    let containerWidth = containerDimensions.width;

    nxtBtn[i].addEventListener('click', () => {
        item.scrollLeft += containerWidth;
    })

    preBtn[i].addEventListener('click', () => {
        item.scrollLeft -= containerWidth;
    })
})