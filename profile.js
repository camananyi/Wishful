function openForm() {
    document.getElementById("popupForm").style.display = "block";
  }
  
  function closeForm() {
    document.getElementById("popupForm").style.display = "none";
  }
  
  let wishlist = [];
  
  window.onload = function () {
    loadWishlist();
  };
  
  // Load existing wishlists from server
  function loadWishlist() {
    fetch('loadmultiwishlist.php', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    })
      .then(response => response.json())
      .then(data => {
        wishlist = data;
        wishlist.forEach(item => renderItem(item));
      })
      .catch(error => console.error('Error loading saved items:', error));
  }
  
  // Add a new wishlist item
  function newElement(event) {
    event.preventDefault();
  
    const wishname = document.querySelector('input[name="wishlist_name"]').value.trim();
    const wishdate = new Date().toLocaleDateString(); // gets current date 
  
    if (!wishname) return;
  
    const wishitem = {
      name: wishname,
      date: wishdate
    };
  
    // Add to local array and render immediately
    wishlist.push(wishitem);
    renderItem(wishitem);
  
    // Send to server
    fetch('create_wishlist.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(wishitem)
    })
      .then(res => res.text())
      .then(text => {
        console.log("Raw response:", text);
        const data = JSON.parse(text); // manually parse
        // now handle data like before
      })
      .then(data => {
        // Optional: update the last item with server response (like an ID)
        console.log("Saved on server:", data);
      })
      .catch(error => console.error('Error saving item:', error));
  
    closeForm();
  }
  
  // Render one wishlist item on the page
  function renderItem(item) {
    const container = document.getElementById("wishlistsContainer");
  
    // Create a clickable link
    const link = document.createElement("a");
    link.href = `profilelist.html?id=${WishlistId}`;
    link.className = "wishlist-link"; // for styling

    const card = document.createElement("div");
    card.className = "card";
  
    const content = document.createElement("div");
    content.className = "container";
  
    const title = document.createElement("h4");
    title.innerHTML = `${item.name}`;
  
    const date = document.createElement("p");
    date.textContent = item.date;
  
    content.appendChild(title);
    content.appendChild(date);
    card.appendChild(content);
  
    container.appendChild(card);
  }
  