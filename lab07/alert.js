function deleteRecord(id) {
  if (confirm("Do you want to delete this record?")) {
    window.location = "delete.php?id=" + id;
  }
}
