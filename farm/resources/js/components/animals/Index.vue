<template>
  <div class="max-w-4xl mx-auto py-8 bg-farm">
    <h1 class="text-3xl font-bold mb-6 text-center text-green-800">Liste des animaux</h1>

    <!-- Filtres -->
    <div class="flex flex-wrap justify-center mb-4 space-x-4">
      <!-- Filtre par type -->
      <div class="mr-4">
        <label for="typeFilter" class="text-gray-700">Filtrer par type:</label>
        <select v-model="selectedType" @change="applyFilters" id="typeFilter" class="block appearance-none bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 rounded shadow-md leading-tight focus:outline-none focus:shadow-outline">
          <option value="">Tous</option>
          <option v-for="type in types" :key="type.id" :value="type.id" class="text-gray-800">{{ type.name }}</option>
        </select>
      </div>

      <!-- Filtre par race -->
      <div class="mr-4">
        <label for="raceFilter" class="text-gray-700">Filtrer par race:</label>
        <select v-model="selectedRace" @change="applyFilters" id="raceFilter" class="block appearance-none bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 rounded shadow-md leading-tight focus:outline-none focus:shadow-outline">
          <option value="">Tous</option>
          <option v-for="race in races" :key="race.id" :value="race.id" class="text-gray-800">{{ race.name }}</option>
        </select>
      </div>

      <!-- Tri par prix -->
      <div>
        <label for="priceSort" class="text-gray-700">Trier par prix:</label>
        <select v-model="sortBy" @change="applySort" id="priceSort" class="block appearance-none bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 rounded shadow-md leading-tight focus:outline-none focus:shadow-outline">
          <option value="asc">Prix croissant</option>
          <option value="desc">Prix décroissant</option>
        </select>
      </div>
    </div>

    <!-- Liste des animaux filtrés et triés -->
    <div v-if="filteredAnimals.length > 0">
      <div v-for="animal in filteredAnimals" :key="animal.id" class="mb-8 p-6 bg-green-50 rounded-lg shadow-md hover:shadow-lg">
        <h2 class="text-2xl font-semibold mb-2 text-green-800">{{ animal.name }}</h2>
        <p class="text-gray-700 mb-2">{{ animal.description }}</p>
        <p class="text-gray-900 font-bold mb-4">{{ animal.price }}€</p>
        <div v-if="animal.pictures.length" class="flex flex-wrap">
          <img v-for="picture in animal.pictures" :src="getPictureUrl(picture)" :key="picture" :alt="`Photo of ${animal.name}`" class="w-32 h-32 object-cover mr-2 mb-2 rounded">
        </div>
        <p class="text-gray-600 mb-2">Type: {{ animal.type.name }}</p>
        <p class="text-gray-600">Race: {{ animal.race.name }}</p>
      </div>
    </div>
    <div v-else>
      <p class="text-center text-gray-700">Aucun animal ne correspond aux critères sélectionnés.</p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      animals: [],
      types: [],
      races: [],
      selectedType: '',
      selectedRace: '',
      sortBy: 'asc'
    }
  },
  mounted() {
    this.fetchAnimals();
    this.fetchTypes();
    this.fetchRaces();
  },
  methods: {
    fetchAnimals() {
      axios.get('/animals/user').then(response => {
        this.animals = response.data.map(animal => ({
          ...animal,
          pictures: JSON.parse(animal.pictures)
        }));
      });
    },
    fetchTypes() {
      axios.get('/types').then(response => {
        this.types = response.data;
      });
    },
    fetchRaces() {
      axios.get('/races').then(response => {
        this.races = response.data;
      });
    },
    getPictureUrl(picture) {
      return `${picture}`;
    },
    applyFilters() {
      let filteredAnimals = this.animals;

      // Filtrage par type
      if (this.selectedType !== '') {
        filteredAnimals = filteredAnimals.filter(animal => animal.type_id == this.selectedType);
      }

      // Filtrage par race
      if (this.selectedRace !== '') {
        filteredAnimals = filteredAnimals.filter(animal => animal.race_id == this.selectedRace);
      }

      // Mettre à jour les animaux filtrés
      this.filteredAnimals = filteredAnimals;
    },
    applySort() {
      // Tri par prix
      if (this.sortBy === 'asc') {
        this.filteredAnimals.sort((a, b) => a.price - b.price);
      } else {
        this.filteredAnimals.sort((a, b) => b.price - a.price);
      }
    }
  },
  computed: {
    filteredAnimals() {
      let filtered = this.animals;

      // Filtrage par type
      if (this.selectedType !== '') {
        filtered = filtered.filter(animal => animal.type_id == this.selectedType);
      }

      // Filtrage par race
      if (this.selectedRace !== '') {
        filtered = filtered.filter(animal => animal.race_id == this.selectedRace);
      }

      return filtered;
    }
  }
}
</script>
