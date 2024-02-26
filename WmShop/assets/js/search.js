function filterItems() {
  var input, filter, container, items, itemName, i;
  input = document.getElementById('searchInput');
  filter = input.value.toUpperCase();
  container = document.getElementById('itemContainer');
  items = container.getElementsByTagName('tr');

  for (i = 0; i < items.length; i++) {
      itemName = items[i].getElementsByTagName('td')[0];
      if (itemName) {
          if (itemName.innerHTML.toUpperCase().indexOf(filter) > -1) {
              items[i].style.display = '';
          } else {
              items[i].style.display = 'none';
          }
      }
  }
}
