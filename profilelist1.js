// add inactive wishlists

document.addEventListener("DOMContentLoaded", function () {
  const inputField = document.getElementById("myInput");
  const linkInputField = document.createElement("input");
  linkInputField.setAttribute("type", "text");
  linkInputField.setAttribute("id", "myLinkInput");
  linkInputField.setAttribute("placeholder", "Enter a link (optional)");
  inputField.insertAdjacentElement("afterend", linkInputField);

  const addButton = document.querySelector(".addBtn");
  const list = document.getElementById("myUL");

  let todoItems = [];

  // Load existing items from localStorage when page loads
  // const savedItems = localStorage.getItem("todoItemsRef");
  load_saved()

  // if (savedItems) {
  //   todoItems = JSON.parse(savedItems);
  //   todoItems.forEach(item => renderItem(item));
  // }

  // function saveToLocalStorage() {
  //   localStorage.setItem("todoItemsRef", JSON.stringify(todoItems));
  // }

  function newElement() {
    const itemName = inputField.value.trim();
    const itemLink = linkInputField.value.trim();

    if (!itemName) return;

    const item = { id: Date.now(), 
                  name: itemName, 
                  link: itemLink };
    todoItems.push(item);
    // saveToLocalStorage(); // Save the updated list

    renderItem(item);
    const jsonData = JSON.stringify(item);

    // Send the JSON data to the server using fetch API
  fetch('callprofilelist.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: jsonData
  })
  .then(response => response.text())
  .then(data => console.log(data))
  .catch(error => console.error('Error:', error));

  inputField.value = "";
  linkInputField.value = "";
  }

  function load_saved() {
    fetch('loadwishlist.php', {
      method: 'GET', 
      headers: {
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      todoItems = data; // Store it in your todoItems array
      todoItems.forEach(item => renderItem(item)); // Render each item
    })
    .catch(error => console.error('Error loading saved items:', error));

  }
  

  function renderItem(item) {
    const li = document.createElement("li");
    li.setAttribute("data-id", item.id);

    if (item.link) {
      const a = document.createElement("a");
      a.href = item.link;
      a.target = "_blank";
      a.textContent = item.name;
      li.appendChild(a);
    } else {
      li.textContent = item.name;
    }

    addCloseButton(li, item.id);
    list.appendChild(li);
  }

  function addCloseButton(li, id) {
    const span = document.createElement("SPAN");
    const txt = document.createTextNode("\u00D7");
    span.className = "close";
    span.appendChild(txt);
    li.appendChild(span);

    span.onclick = function () {
      li.remove();
      todoItems = todoItems.filter(item => item.id !== id);
      // saveToLocalStorage(); // Save changes after deletion

      const jsonData = JSON.stringify({ id: id });
      fetch('deleteitem.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        },
        body: jsonData
      })
      .then(response => response.text())
      .then(data => console.log(data))
      .catch(error => console.error('Error:', error));
    
      }
  }

  addButton.addEventListener("click", newElement);
  inputField.addEventListener("keypress", event => {
    if (event.key === "Enter") newElement();
  });
  linkInputField.addEventListener("keypress", event => {
    if (event.key === "Enter") newElement();
  });
});

