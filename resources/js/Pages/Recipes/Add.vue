<script setup>
import { ref } from 'vue';
import { useForm } from '@inertiajs/vue3';
import ActionMessage from '@/Components/ActionMessage.vue';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import TextareaInput from '@/Components/TextareaInput.vue';
import '@/../css/recipe/add.css';

// const passwordInput = ref(null);
// const currentPasswordInput = ref(null);
const emit = defineEmits(['close'])
const form = useForm({
    date: '',
    breakfast: '',
    lunch: '',
    dinner: '',
});

const createRecipe = () => {
    form.post(route('recipes.store'), {
        errorBag: 'newRecipe',
        preserveScroll: true,
        onSuccess: () => {form.reset();emit('close')},
        onError: () => {},
        onFinish: () => {
           alert('Recipe created successfully!');
        }
    });
};
</script>

<template>
    <div class="mask">
        <FormSection @submitted="createRecipe">
            <!-- <template #title>
            Update Password
        </template>

        <template #description>
            Ensure your account is using a long, random password to stay secure.
        </template> -->

            <template #form class="add-form">
                <div class="form-header">
                    <h2>Add</h2>
                    <span @click="emit('close')">×</span>
                </div>

                <div class="">
                    <InputLabel for="date" value="date" />
                    <TextInput id="date" ref="dateInput" v-model="form.date" type="text"
                        class="mt-1 block w-full" />
                    <InputError :message="form.errors.date" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="breakfast" value="breakfast" />
                    <TextareaInput id="breakfast" ref="breakfastInput" v-model="form.breakfast" type="textarea"
                        class="mt-1 block w-full" />
                    <InputError :message="form.errors.breakfast" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="lunch" value="lunch" />
                    <TextareaInput id="lunch" v-model="form.lunch" type="textarea"
                        class="mt-1 block w-full" />
                    <InputError :message="form.errors.lunch" class="mt-2" />
                </div>

                <div class="col-span-6 sm:col-span-4">
                    <InputLabel for="dinner" value="dinner" />
                    <TextareaInput id="dinner" v-model="form.dinner" type="textarea"
                        class="mt-1 block w-full" />
                    <InputError :message="form.errors.dinner" class="mt-2" />
                </div>
            </template>

            <template #actions>
                <ActionMessage :on="form.recentlySuccessful" class="mr-3">
                    Saved.
                </ActionMessage>

                <PrimaryButton>
                    submit
                </PrimaryButton>
            </template>
        </FormSection>
    </div>
</template>
