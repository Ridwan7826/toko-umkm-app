import { test, expect } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage.js';
import { DashboardPage } from '../pages/DashboardPage.js';
import { getSeederUser } from '../helpers/db.js';

test.describe('Admin Category CRUD', () => {
    let dashboardPage;

    test.beforeEach(async ({ page }) => {
        const loginPage = new LoginPage(page);
        dashboardPage = new DashboardPage(page);
        await loginPage.goto();
        const user = getSeederUser('admin');
        await loginPage.fillCredentials(user.email, user.password);
        await loginPage.submit();
        await dashboardPage.verifyRole('admin');
    });

    test('Can create, edit, and delete a category', async ({ page }) => {
        await dashboardPage.gotoMenu('Kategori Produk');
        await expect(page.getByText('Daftar Kategori Produk', { exact: true })).toBeVisible();

        await page.getByRole('link', { name: '+ Tambah Data Baru' }).click();
        await expect(page.getByText('Tambah Kategori Baru', { exact: true })).toBeVisible();
        
        const categoryName = 'Elektronik ' + Date.now();
        await page.locator('input[name="name"]').fill(categoryName);
        await page.getByRole('button', { name: 'Simpan Perubahan' }).click();

        await expect(page.getByText('Berhasil!').first()).toBeVisible();
        await expect(page.getByText(categoryName)).toBeVisible();

        const row = page.locator('tr').filter({ hasText: categoryName });
        await row.getByRole('link', { name: 'Ubah' }).click();

        const updatedName = categoryName + ' Update';
        await page.locator('input[name="name"]').fill(updatedName);
        await page.getByRole('button', { name: 'Simpan Perubahan' }).click();
        
        await expect(page.getByText('Berhasil!').first()).toBeVisible();
        await expect(page.getByText(updatedName)).toBeVisible();

        page.on('dialog', dialog => dialog.accept());
        await page.locator('tr').filter({ hasText: updatedName }).getByRole('button', { name: 'Hapus' }).click();

        await expect(page.getByText('Berhasil!')).toBeVisible();
        await expect(page.getByText(updatedName)).not.toBeVisible();
    });
});
