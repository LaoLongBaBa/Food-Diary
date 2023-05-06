<script setup>
import {
    Head,
    useForm
} from '@inertiajs/vue3';
import {ref} from 'vue';
import '@/../css/recipe/index.css';
import AppLayout from '@/Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Add from './Add.vue'

defineProps({
    content: Object,
    dates: Array,
    selectedDate: String,
});
</script>
<template>
    <AppLayout title="Recipes">

        <Head title="Recipes"/>
        <div class="page">
            <Add v-if="showDialog" @close="close"/>
            <!-- <header>
                <h1>{{ pageTitle }}</h1>
            </header> -->
            <div class="page-box">
                <menu>
                    <ul>
                        <li :class="selectedDate === date ? 'active' : ''" v-for="date in dates" :key="date"
                            @click="selectedDate = date">{{ date }}
                        </li>
                    </ul>
                    <button class="add" @click="showModal">New Recipe</button>
                </menu>
                <form @submit.prevent="saveContent(content[selectedDate].id)">
                    <div class="content">
                        <h2 class="content-title">Breakfast</h2>
                        <p class="content-text" v-if="!editMode">{{ content[selectedDate].breakfast }}</p>
                        <div v-else class="form-item">
                            <input id="date" type="hidden" v-model="content[selectedDate].date"/>
                            <input required ref="breakfast" id="breakfast" type="text"
                                   v-model="content[selectedDate].breakfast"/>
                            <InputError :message="form.errors.breakfast" class="mt-2"/>
                        </div>
                        <h2 class="content-title">Lunch</h2>
                        <p class="content-text" v-if="!editMode">{{ content[selectedDate].lunch }}</p>
                        <div v-else class="form-item">
                            <input required ref="lunch" id="lunch" type="text" v-model="content[selectedDate].lunch"/>
                            <InputError :message="form.errors.lunch" class="mt-2"/>
                        </div>
                        <h2 class="content-title">Dinner</h2>
                        <p class="content-text" v-if="!editMode">{{ content[selectedDate].dinner }}</p>
                        <div v-else class="form-item">
                            <input required type="text" id="dinner" v-model="content[selectedDate].dinner"/>
                            <InputError :message="form.errors.dinner" class="mt-2"/>
                        </div>
                        <div class="btn-box" v-if="!editMode">
                            <button class="edit" @click="showEditMode">Edit</button>
                            <button class="delete" v-if="!editMode"
                                    @click="deleteRecipe(content[selectedDate].id)">Delete
                            </button>
                        </div>
                        <div class="btn-box" v-else>
                            <PrimaryButton class="save" :disabled="form.processing">Save</PrimaryButton>
                            <button class="cancel" @click="cancelEdit">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </AppLayout>

    <div class="home-footer">
        <span>Copyright © 2023 Food Diary  </span>
        <a href="">Accessibility</a>
        <a href="">Terms & conditions</a>
        <a href="">Privacy policy</a>
        <a href="">Cookie policy</a>
    </div>
</template>

<script>
export default {
    data() {
        return {
            pageTitle: '',
            showDialog: false,
            newContent: "",
            editMode: false,
            form: useForm({
                _method: 'PUT',
                date: '',
                breakfast: '',
                lunch: '',
                dinner: '',
            })
        };
    },
    methods: {
        showModal() {
            this.showDialog = true;
        },
        showEditMode() {
            this.editMode = true;
        },
        close() {
            this.showDialog = false;
        },
        submitContent() {
            if (this.newContent) {
                this.content[this.selectedDate].dinner = this.newContent;
                this.newContent = "";
                this.showDialog = false;
            }
        },
        deleteRecipe(id) {
            if (confirm('Are you sure you want to delete this recipe?')) {
                // Delete the recipe
                this.form.delete(route('recipes.destroy', id), {
                    preserveScroll: true,
                    onSuccess: () => {
                        alert('Recipe deleted successfully!');
                    },
                    onError: () => console.log('error'),
                    onFinish: () => this.form.reset(),
                });
            }
        },
        cancelEdit() {
            this.editMode = false;
        },
        saveContent(id) {
            this.form.breakfast = breakfast.value;
            this.form.lunch = lunch.value;
            this.form.dinner = dinner.value;
            this.form.date = date.value;
            // console.log(this.form)
            this.form.put(route('recipes.update', id), {
                onSuccess: (res) => {
                    // console.log(res)
                    alert('Recipe updated successfully!');
                },
                onFinish: () => {
                    this.editMode = false;
                    this.form.reset()
                },
            });
        }
    }
};
</script>
