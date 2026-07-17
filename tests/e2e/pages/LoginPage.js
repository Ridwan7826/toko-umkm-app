import { expect } from '@playwright/test';
export class LoginPage {
    constructor(page) { this.page = page; }
    async goto() { await this.page.goto('/login'); }
    async fillCredentials(email, pass) {
        await this.page.getByLabel('Email').fill(email);
        await this.page.getByLabel('Password').fill(pass);
    }
    async submit() { await this.page.getByRole('button', { name: 'Log in' }).click(); }
}
