<template>
        <table class="table-fixed container text-left m-auto mt-6 bg-white shadow border-collapse border border-slate-200">
            <thead class="">
                <tr>
                <th class="p-3 border border-slate-400">Kunde</th>
                <th class="p-3 border border-slate-400">Type</th>
                <th class="p-3 border border-slate-400">Plademål</th>
                <th class="p-3 border border-slate-400">Antal</th>
                </tr>
            </thead>
            <tbody class="" v-for="item in warehouseItems" :key="item.id">
                <tr>
                <td class="p-3 border border-slate-200">{{ item.customer }}</td>
                <td class="p-3 border border-slate-200">{{ item.type }}</td>
                <td class="p-3 border border-slate-200">{{ item.measure }}</td>
                <td class="p-3 border border-slate-200">{{ item.amount }}</td>
                </tr>
            </tbody>
        </table>
  </template>
  
  
  <script>
 export default {
  data() {
    return {
      warehouseItems: [],
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
  },
  // ... other component options
};
  </script>
  