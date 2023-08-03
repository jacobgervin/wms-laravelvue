<template>
        <form @submit.prevent="createWarehouseItem">
          <table class="table-fixed container text-left m-auto mt-6 bg-white shadow border-collapse border border-slate-200">
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
                    <td class="p-3 border border-slate-200"><input type="text" class="border-slate-300 bg-slate-100 max-w-[99%]" id="customer" v-model="newItem.customer" placeholder="Kunde" required></td>
                    <td class="p-3 border border-slate-200"><input type="text" class="border-slate-300 bg-slate-100 max-w-[99%]" id="type" v-model="newItem.type" placeholder="Type" required></td>
                    <td class="p-3 border border-slate-200"><input type="text" class="border-slate-300 bg-slate-100 max-w-[99%]" id="measure" v-model="newItem.measure" placeholder="0 x 0 x 0" required></td>
                    <td class="p-3 border border-slate-200"><input type="text" class="border-slate-300 bg-slate-100 max-w-[99%]" id="amount" v-model.number="newItem.amount" placeholder="0" required></td>
                    <td class="p-3 border border-slate-200"><button type="submit" class="bg-black py-2 px-6 text-white">Tilføj</button></td>
                </tr>

            </tbody>
        </table>
      </form>
        <table class="table-fixed container text-left m-auto mt-6 bg-white shadow border-collapse border border-slate-200">
            <thead class="">
                <tr class="">
                <th class="p-3 border border-slate-200">Kunde</th>
                <th class="p-3 border border-slate-200">Type</th>
                <th class="p-3 border border-slate-200">Plademål</th>
                <th class="p-3 border border-slate-200">Antal</th>
                <th class="p-3 border border-slate-200"></th>

                </tr>
            </thead>
            <tbody class="" v-for="item in warehouseItems" :key="item.id">
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
                <button class="hover:font-bold p-3">
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
  </template>
  
  
  <script>
import axios from 'axios';

 export default {
  data() {
    return {
      warehouseItems: [],
      newItem: {
        customer: '',
        type: '',
        measure: '',
        amount: '',
      },
    };
  },
  created() {
    this.fetchWarehouseItems();
  },
  methods: {
    fetchWarehouseItems() {
      axios.get('/warehouse')
        .then((response) => {
          this.warehouseItems = response.data.data;
        })
        .catch((error) => {
          console.error(error);
        });
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

    updateWarehouseItem(item) {
      axios
        .put(`/warehouse/${item.id}`, item) // Send a PUT request to update the item in the backend
        .then((response) => {
          console.log(response.data); // Log the response (optional)
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
  