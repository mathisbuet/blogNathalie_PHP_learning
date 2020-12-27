function validate() {
    if (document.getElementById("status").value === "published") {
      return confirm('Are you sure?');
    } else {
      console.log('Not Ready');
      return false;
    }
  }