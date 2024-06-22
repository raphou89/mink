<template>
    <div class="max-w-4xl mx-auto py-8">
      <h1 class="text-3xl font-bold mb-6 text-center">Tableau de bord des animaux</h1>
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded-lg overflow-hidden shadow-md text-center">
          <thead class="bg-gray-800 text-white">
            <tr>
              <th class="px-4 py-2">Nom</th>
              <th class="px-4 py-2">Âge</th>
              <th class="px-4 py-2">Type</th>
              <th class="px-4 py-2">Race</th>
              <th class="px-4 py-2">Description</th>
              <th class="px-4 py-2">Statut</th>
              <th class="px-4 py-2">Prix</th>
              <th class="px-4 py-2">Photos</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="animal in animals" :key="animal.id" class="text-gray-700">
              <td class="border px-4 py-2">{{ animal.name }}</td>
              <td class="border px-4 py-2">{{ animal.age }}</td>
              <td class="border px-4 py-2">{{ animal.type.name }}</td>
              <td class="border px-4 py-2">{{ animal.race.name }}</td>
              <td class="border px-4 py-2">{{ animal.description }}</td>
              <td class="border px-4 py-2">{{ animal.status }}</td>
              <td class="border px-4 py-2">{{ animal.price }}€</td>
              <td class="border px-4 py-2">
                <div v-if="animal.pictures.length" class="flex flex-wrap">
                  <img v-for="picture in animal.pictures" :key="picture" :src="getPictureUrl(picture)" :alt="`Photo of ${animal.name}`" class="w-12 h-12 object-cover mr-2 mb-2 rounded">
                </div>
                <div v-else class="text-gray-400">Pas de photo</div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        animals: [],
      }
    },
    mounted() {
      this.fetchAnimals();
    },
    methods: {
    fetchAnimals() {
        axios.get('/animals/admin').then(response => {
        this.animals = response.data.map(animal => ({
            ...animal,
            pictures: JSON.parse(animal.pictures)
        }));
        });
    },
    getPictureUrl(picture) {
      return `${picture}`;
    },
    }
  }
  </script>
  