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

  addButton.addEventListener('click', () => {
    inputForm.classList.remove('hidden');
    addButton.classList.add('hidden');
  });

  saveButton.addEventListener('click', () => {
    const val1 = val1Input.value;
    const val2 = val2Input.value;
    const val3 = val3Input.value;

    data.push({ col1: val1, col2: val2, col3: val3 });
    console.log(data);

    const row = document.createElement('tr');
    row.innerHTML = `
      <td class="border border-gray-300 p-2">${val1}</td>
      <td class="border border-gray-300 p-2">${val2}</td>
      <td class="border border-gray-300 p-2">${val3}</td>
    `;
    pricingTable.appendChild(row);

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
});
