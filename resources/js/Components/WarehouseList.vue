<template>
        <div class="container m-auto mt-6 flex flex-row items-center">
        <h1 class="text-xl font-bold">Opret Materiale</h1>
      </div>
      <div class="relative">
        <form @submit.prevent="createWarehouseItem">
          <table class="table-fixed container text-left m-auto mt-3 bg-white shadow border-collapse border border-slate-200">
            <thead class="">
                <tr class="">
                <th class="p-3 border border-slate-200">Kunde</th>
                <th class="p-3 border border-slate-200">Type</th>
                <th class="p-3 border border-slate-200">Plademål</th>
                <th class="p-3 border border-slate-200">Antal</th>
                </tr>
            </thead>
            <tbody>
                <tr class="">
                    <td class="p-3 border border-slate-200"><input type="text" class="border-slate-300 bg-slate-100 max-w-[99%] valid:border-green-500" id="customer" v-model="newItem.customer" placeholder="Kunde" required></td>
                    <td class="p-3 border border-slate-200"><input type="text" class="border-slate-300 bg-slate-100 max-w-[99%] valid:border-green-500" id="type" v-model="newItem.type" placeholder="Type" required></td>
                    <td class="p-3 border border-slate-200"><input type="text" class="border-slate-300 bg-slate-100 max-w-[99%] valid:border-green-500" id="measure" v-model="newItem.measure" placeholder="0 x 0 x 0" required></td>
                    <td class="p-3 border border-slate-200"><input type="text" class="border-slate-300 bg-slate-100 max-w-[99%] valid:border-green-500" id="amount" v-model.number="newItem.amount" placeholder="0" required></td>
                    <td class="p-3 border border-slate-200"><button type="submit" class="bg-black py-2 px-6 text-white">Tilføj</button></td>
                </tr>

            </tbody>
        </table>
      </form>
      <div class="container m-auto mt-6 flex flex-row justify-between items-center">
        <h1 class="text-xl font-bold">Materialer</h1>
        <form class="ml-4" action=""><input class="border-slate-300 bg-slate-100" type="text" placeholder="Søg"></form>
      </div>

        <table class="table-fixed container text-left m-auto mt-3 bg-white shadow border-collapse border border-slate-200">
            <thead class="">
                <tr class="">
                <th class="p-3 border border-slate-200 hover:bg-slate-100 cursor-pointer" @click="sortColumn('customer')">Kunde</th>
                <th class="p-3 border border-slate-200 hover:bg-slate-100 cursor-pointer" @click="sortColumn('type')">Type</th>
                <th class="p-3 border border-slate-200 hover:bg-slate-100 cursor-pointer" @click="sortColumn('measure')">Plademål</th>
                <th class="p-3 border border-slate-200 hover:bg-slate-100 cursor-pointer" @click="sortColumn('amount')">Antal</th>
                <th class="p-3 border border-slate-200 hover:bg-slate-100 cursor-pointer"></th>

                </tr>
            </thead>
            <tbody class="" v-for="item in sortedWarehouseItems" :key="item.id">
                <tr class="hover:bg-slate-100">
                <td class="p-3 border border-slate-200">{{ item.customer }}</td>
                <td class="p-3 border border-slate-200">{{ item.type }}</td>
                <td class="p-3 border border-slate-200">{{ item.measure }}</td>
                <td class="p-3 border border-slate-200 relative"><div class="flex flex-row">{{ item.amount }}
                  <div class="absolute right-6 space-x-6">
                <button @click="increaseAmount(item)">+</button>
                <button @click="decreaseAmount(item)">-</button>
                  </div>
                  </div>
               </td>
               <td class="p-3 border border-slate-200 space-x-3 "> 
                <button class="hover:font-bold p-3" v-on:click="editModal = !editModal" @click="editWarehouseItem(item)">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                  </svg>
                </button>

                <button class="hover:font-bold text-rose-600" @click="deleteWarehouseItem(item)">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                  </svg>
                </button>
                </td>
                </tr>
            </tbody>
        </table>
      </div>
      <div v-if="editModal" class="fixed top-0">
      <div v-on:click="editModal = !editModal" class=" relative w-screen h-screen  m-auto p-3 bg-black flex flex-col justify-center opacity-90 items-center">
      </div>
      <div>
        <form @submit.prevent="changeWarehouseItemValues(editItem)">
        <table  class="table-fixed absolute top-1/2 left-1/2 transform -translate-x-1/2 container text-left m-auto  bg-white shadow border-collapse border border-slate-200">
            <thead class="" v-for="edititems in editItem" :key="editItem.id" >
                <tr class="">
                <th class="p-3 border border-slate-200 hover:bg-slate-100 cursor-pointer">Kunde: {{ edititems.customer }}</th>
                <th class="p-3 border border-slate-200 hover:bg-slate-100 cursor-pointer">Type: {{ edititems.type }}</th>
                <th class="p-3 border border-slate-200 hover:bg-slate-100 cursor-pointer">Plademål: {{ edititems.measure }}</th>
                <th class="p-3 border border-slate-200 hover:bg-slate-100 cursor-pointer">Mængde: {{ edititems.amount }}</th>
                <th class="p-3 border border-slate-200 hover:bg-slate-100 cursor-pointer"></th>

                </tr>
            </thead>
            <tbody class="" >
                <tr class="hover:bg-slate-100">
                <td class="p-3 border border-slate-200"><input type="text" id="customer" v-model="editedItem.customer"></td>
                <td class="p-3 border border-slate-200"><input type="text" id="type"  v-model="editedItem.type"> </td>
                <td class="p-3 border border-slate-200"><input type="text" id="measure"  v-model="editedItem.measure"> </td>
                <td class="p-3 border border-slate-200 relative"><input type="text" id="amount"  v-model="editedItem.amount" > </td>
               <td class="p-3 border border-slate-200 space-x-3"> 
                <button class="hover:font-bold p-3" type="submit" >
                Save
                </button>
                </td>
                </tr>
            </tbody>
        </table>
        </form>
      </div>
      </div>
  </template>
  
  
  <script>
import axios from 'axios';

 export default {
  data() {
    return {
      sortKey: '',
      sortDirection: 'asc',
      warehouseItems: [],
      editItem: [],
      newItem: {
        customer: '',
        type: '',
        measure: '',
        amount: '',
      },
      editedItem: {
        customer: '',
        type: '',
        measure: '',
        amount: '',
      },
      editModal: false
    };
  },

  computed: {
  sortedWarehouseItems() {
    const items = [...this.warehouseItems]; // Create a shallow copy of the array

    // Apply sorting based on the current sortKey and sortDirection
    if (this.sortKey) {
      items.sort((a, b) => {
        const aValue = a[this.sortKey];
        const bValue = b[this.sortKey];

        if (aValue === bValue) return 0;
        return this.sortDirection === 'asc' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
      });
    }

    return items;
  }
},

  created() {
    this.fetchWarehouseItems();
  },
  methods: {
    fetchWarehouseItems() {
      axios.get('/warehouse')
        .then((response) => {
          this.warehouseItems = response.data.data;
          console.log(this.warehouseItems)
        })
        .catch((error) => {
          console.error(error);
        });
    },

    sortColumn(key) {
    if (this.sortKey === key) {
      // If the same column is clicked, toggle the sorting direction
      this.sortDirection = this.sortDirection === 'asc' ? 'desc' : 'asc';
    } else {
      // If a new column is clicked, set the sortKey and default to ascending
      this.sortKey = key;
      this.sortDirection = 'asc';
    }
  },
    increaseAmount(item) {
      item.amount++; // Increment the amount of the item
      this.updateWarehouseItem(item);
    },

    decreaseAmount(item) {
      if (item.amount > 0) {
        item.amount--; // Decrement the amount of the item (if it's greater than 0)
        this.updateWarehouseItem(item);
      }
    },
    sortByCustomer(){

    },

    updateWarehouseItem(item) {
      axios
        .put(`/warehouse/${item.id}`, item) // Sender en PUT request.
        .then((response) => {
          console.log(response.data);
        })
        .catch((error) => {
          console.error(error);
        });
    },

    editWarehouseItem(item){
      axios
      .get(`/warehouse/${item.id}`, item) // Henter varen fra databasen
      .then((response) => {
        this.editItem = response.data; // Gemmer varen i editItem
      })
    },

    changeWarehouseItemValues(editItem) { // Tager editItem varen
  axios
    .put(`/warehouse/${editItem.data.id}`, this.editedItem) // Bruger PUT til at opdatere editItem varen
    .then((response) => {
      axios.get('/warehouse') // Opdaterer vores liste
        .then((response) => {
          this.warehouseItems = response.data.data;
        });
      this.editedItem = { // Tømmer editedItem
            customer: '',
            type: '',
            measure: '',
            amount: '',
          };
      this.editModal = false;
    })
    .catch((error) => {
      console.error(error);
    });
},

    createWarehouseItem() {
      axios
        .post('/warehouse', this.newItem) // Send a POST request to create a new item in the backend
        .then((response) => {
          // The backend should return the created item with a unique ID
          // Add the new item to the list
          this.warehouseItems.push(response.data.data);

          // Clear the form after successful creation
          this.newItem = {
            customer: '',
            type: '',
            measure: '',
            amount: '',
          };
        })
        .catch((error) => {
          console.error(error);
        });
    },
    deleteWarehouseItem(item){
      axios
      .delete(`/warehouse/${item.id}`, item)
      .then((response) => {
        axios.get('/warehouse')
        .then((response) => {
          this.warehouseItems = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
        })
        .catch((error) => {
          console.error(error);
        });
    }
  },
  // ... other component options
};
  </script>
  