## Build A Laravel App With TDD

It's time to take the techniques we learned in Laravel From Scratch, and put them to good use building your first real-world application. Together, we'll leverage TDD to create Birdboard: a minimal Basecamp-like project management app.

This series will give us a wide range of opportunities to pull up our sleeves and test our Laravel chops. As always, we start from scratch

 ## Run tests
 ./vendor/bin/sail artisan test

## Testing
sail artisan test --filter ***

![Screenshot](laravel-tdd.png)

```
async submit()
{
    try {
        let response = await  axios.post('/projects', this.formData);

        location = location.data.message;
    } catch (error)
    {
        this.errors = error.respone.errors;
    }
}
```
