document.addEventListener('DOMContentLoaded', () => {
  const data = [];
  const addButton = document.getElementById('add-button');
  const saveButton = document.getElementById('save-button');
  const cancelButton = document.getElementById('cancel-button');
  const inputForm = document.getElementById('input-form');
  const pricingTable = document.getElementById('pricing-tbody');
  const val1Input = document.getElementById('val1');
  const val2Input = document.getElementById('val2');
  const val3Input = document.getElementById('val3');

  let editingRow = null;

  addButton.addEventListener('click', () => {
    inputForm.classList.remove('hidden');
    addButton.classList.add('hidden');
  });

  saveButton.addEventListener('click', () => {
    const val1 = val1Input.value;
    const val2 = val2Input.value;
    const val3 = val3Input.value;

    if (editingRow) {
      const rowData = editingRow.dataset;
      data[rowData.index] = { col1: val1, col2: val2, col3: val3 };
      editingRow.children[0].textContent = val1;
      editingRow.children[1].textContent = val2;
      editingRow.children[2].textContent = val3;
      editingRow = null;
    } else {
      data.push({ col1: val1, col2: val2, col3: val3 });
      const rowIndex = data.length - 1;

      const row = document.createElement('tr');
      row.setAttribute('data-index', rowIndex);
      row.innerHTML = `
        <td>${val1}</td>
        <td>${val2}</td>
        <td>${val3}</td>
        <td>
          <button class="edit-button">Edit</button>
          <button class="delete-button">Delete</button>
        </td>
      `;
      pricingTable.appendChild(row);
    }

    inputForm.classList.add('hidden');
    addButton.classList.remove('hidden');
    val1Input.value = '';
    val2Input.value = '';
    val3Input.value = '';
  });

  cancelButton.addEventListener('click', () => {
    inputForm.classList.add('hidden');
    addButton.classList.remove('hidden');
  });

  pricingTable.addEventListener('click', (event) => {
    if (event.target.classList.contains('edit-button')) {
      const row = event.target.closest('tr');
      const rowIndex = row.dataset.index;
      const rowData = data[rowIndex];

      val1Input.value = rowData.col1;
      val2Input.value = rowData.col2;
      val3Input.value = rowData.col3;

      inputForm.classList.remove('hidden');
      addButton.classList.add('hidden');
      editingRow = row;
    }

    if (event.target.classList.contains('delete-button')) {
      const row = event.target.closest('tr');
      const rowIndex = row.dataset.index;
      
      data.splice(rowIndex, 1);
      row.remove();
      updateIndices();
    }
  });

  function updateIndices() {
    const rows = pricingTable.querySelectorAll('tr');
    rows.forEach((row, index) => {
      row.setAttribute('data-index', index);
    });
  }
});