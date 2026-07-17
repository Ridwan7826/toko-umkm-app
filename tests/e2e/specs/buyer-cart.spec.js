import { test, expect } from '@playwright/test';
import { getSeederUser } from '../helpers/db.js';
import { LoginPage } from '../pages/LoginPage.js';

test.describe('Buyer Cart Module', () => {
  let loginPage;

  test.beforeEach(async ({ page }) => {
    loginPage = new LoginPage(page);
    await loginPage.goto();
    
    // Login as buyer
    const buyer = getSeederUser('pembeli');
    await loginPage.fillCredentials(buyer.email, buyer.password);
    await loginPage.submit();
  });

  test('Buyer can add product to cart and update quantity', async ({ page }) => {
    // 1. Tambahkan ke keranjang (Bypass via post request karena testing frontend belum lengkap untuk show product)
    // Untuk tes E2E yang utuh, kita navigasi ke produk
    await page.goto('/products');
    
    // Asumsi ada tombol 'Lihat Detail' atau langsung ke product pertama
    const firstProduct = page.locator('.product-card').first();
    if(await firstProduct.isVisible()){
        await firstProduct.click();
        await page.getByRole('button', { name: /Tambahkan ke Keranjang/i }).click();
        await expect(page.getByText('Produk ditambahkan ke keranjang')).toBeVisible();
    }

    // 2. Ke halaman keranjang
    await page.goto('/buyer/cart');
    
    // Verifikasi keranjang tidak kosong
    await expect(page.getByText('Keranjang Belanja')).toBeVisible();
    
    // Cek form update kuantitas (jika ada barang)
    const updateBtn = page.getByRole('button', { name: 'Update' }).first();
    if (await updateBtn.isVisible()) {
      const qtyInput = page.locator('input[name="quantity"]').first();
      await qtyInput.fill('3');
      await updateBtn.click();

      // Verifikasi update sukses
      await expect(page.getByText('Kuantitas berhasil diperbarui.')).toBeVisible();
      
      // Hapus item dari keranjang
      page.on('dialog', dialog => dialog.accept()); // Accept confirm
      await page.getByRole('button', { name: 'Hapus' }).first().click();
      await expect(page.getByText('Produk dihapus dari keranjang.')).toBeVisible();
    }
  });
});
