function filterItems() {
    var input, filter, container, items, itemName, i;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    container = document.getElementById('itemContainer');
    items = container.getElementsByClassName('subContainer');

    for (i = 0; i < items.length; i++) {
        itemName = items[i].getElementsByClassName('itemName')[0];
        if (itemName.innerHTML.toUpperCase().indexOf(filter) > -1) {
            items[i].style.display = 'flex'; // Use 'flex' to show the element
        } else {
            items[i].style.display = 'none';
        }
    }
}
