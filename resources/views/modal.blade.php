<div role="dialog" aria-modal="true" tabindex="0" x-show="open" @click="open = false; $refs.modal1_button.focus()"
    @click.away="open = false; $refs.modal1_button.focus()"
    class="fixed flex h-screen top-0 left-0 w-full justify-center items-center">
    <div class="absolute w-1/3 opacity-60" aria-hidden="true" x-show="open"></div>
    <div @click.stop="" x-show="open"
        class="flex flex-col rounded-lg shadow-lg overflow-hidden bg-white w-3/5 h-min z-10 p-10">
        <h1 class="font-normal text-2xl mb-15 text-center pb-5">Let's Start Something New
        </h1>
        <form x-data="ContactForm()" @submit.prevent="submitForm">
            <div class="flex">
                <div class="flex-1 mr-4">
                    <div class="mb-4">
                        <label for="title" class="text-sm mb-2">Title</label>
                        <input type="text" id="title" class="border p-2 text-xs block w-full rounded"
                            placeholder="Write a Title" x-model="formData.title"
                            :class="errors.title ? 'border-2 border-rose-600' : 'border-muted-light'">
                    </div>
                    <span class="text-xs talic text-rose-600" x-if="errors.title" x-text="errors.title"></span>
                    <div class="mb-4">
                        <label for="description" class="text-sm mb-2">Description</label>
                        <textarea id="description" class="border p-2 text-xs block w-full rounded" rows="7"
                            placeholder="Project Description" x-model="formData.description"
                            :class="errors.description ? 'border-2 border-rose-600' : 'border-muted-light'"></textarea>
                        <span class="text-xs italic text-rose-600" x-if="errors.description"
                            x-text="errors.description"></span>
                    </div>
                </div>
                <div class="flex-1 ml-4" x-data="{ tasks: [{ value: '' }] }">
                    <div class="mb-4">
                        <label for="task" class="text-sm mb-2">Need Some Tasks?</label>
                        <template x-for="(task, index, tasks) in tasks" :key="index">
                            <input multiple type="text" id="task" x-model="formData.tasks[index]"
                                class="border border-muted-light p-2 text-xs block w-full rounded mb-2"
                                placeholder="New Task">
                        </template>
                    </div>
                    <div class="inline-flex items-center">
                        <button type="button" class="mr-2" @click="tasks.push({value: ''})">+</button>
                        <span class="text-xs">Add New Task Field</span>
                    </div>
                </div>
            </div>
            <footer class="flex justify-end">
                            <button type="button" class="button" @click="open = false">Cancel</button>
                <button class="button mr-4" type="submit">Create Project</button>
            </footer>
        </form>
    </div>
</div>
<script>
    function ContactForm() {
        return {
            formData: {
                title: "",
                description: "",
                tasks: {}
            },
            errors: {},

            submitForm() {
                axios.post('/projects', this.formData)
                    .then(response => {
                        location = response.data.message;
                    })
                    .catch(error => {
                        console.log(error.response.data);
                        this.errors = error.response.data.errors;
                    });
            }
        };
    };
</script>
