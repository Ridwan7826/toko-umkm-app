import { test, expect } from '@playwright/test';
import { getSeederUser } from '../helpers/db.js';
import { LoginPage } from '../pages/LoginPage.js';

test.describe('Seller Shop Profile Module', () => {
  let loginPage;

  test.beforeEach(async ({ page }) => {
    loginPage = new LoginPage(page);
    await loginPage.goto();
    
    // Login as seller
    const seller = getSeederUser('penjual');
    await loginPage.fillCredentials(seller.email, seller.password);
    await loginPage.submit();
  });

  test('Seller can update shop profile information', async ({ page }) => {
    // 1. Ke halaman edit profil toko
    await page.goto('/seller/shop'); // route('seller.shop.edit')
    
    // Asumsi halaman memuat judul
    await expect(page.getByText('Edit Profil Toko')).toBeVisible();
    
    // 2. Isi form
    await page.fill('input[name="name"]', 'Toko Kita Updated E2E');
    await page.fill('textarea[name="description"]', 'Deskripsi toko berhasil diupdate via E2E Testing Playwright.');
    await page.fill('textarea[name="address"]', 'Jl. Baru No. 123 E2E');

    // 3. Simpan Perubahan
    await page.getByRole('button', { name: 'Simpan Perubahan' }).click();

    // 4. Verifikasi
    await expect(page.getByText('Profil toko berhasil diperbarui.')).toBeVisible();
  });
});
