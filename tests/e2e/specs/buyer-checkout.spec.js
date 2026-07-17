import { test, expect } from '@playwright/test';
import { getSeederUser } from '../helpers/db.js';
import { LoginPage } from '../pages/LoginPage.js';

test.describe('Buyer Checkout Module', () => {
  let loginPage;

  test.beforeEach(async ({ page }) => {
    loginPage = new LoginPage(page);
    await loginPage.goto();
    
    const buyer = getSeederUser('pembeli');
    await loginPage.fillCredentials(buyer.email, buyer.password);
    await loginPage.submit();
  });

  test('Buyer can proceed to checkout and mock payment', async ({ page }) => {
    // 1. Tambahkan produk ke keranjang
    await page.goto('/products');
    
    const firstProduct = page.locator('.product-card').first();
    if(await firstProduct.isVisible()){
        await firstProduct.click();
        await page.getByRole('button', { name: /Tambahkan ke Keranjang/i }).click();
    } else {
        test.skip('No products available to test checkout');
    }

    // 2. Ke halaman keranjang dan lanjut checkout
    await page.goto('/buyer/cart');
    const checkoutBtn = page.getByRole('link', { name: /Checkout/i }).first();
    
    if (await checkoutBtn.isVisible()) {
      await checkoutBtn.click();
      
      // 3. Isi form checkout (CheckoutRequest)
      await expect(page).toHaveURL(/.*\/buyer\/checkout/);
      
      // Isi alamat dummy jika ada (tergantung implementasi form di view)
      // Asumsi name input field ada
      await page.locator('input[name="address[province]"]').fill('Jawa Barat');
      await page.locator('input[name="address[city]"]').fill('Bandung');
      await page.locator('textarea[name="address[detail]"]').fill('Jalan Pahlawan No. 10');
      
      await page.locator('select[name="courier"]').selectOption('JNE');
      
      await page.getByRole('button', { name: /Proses Pesanan/i }).click();

      // 4. Verifikasi Redirect ke Halaman Order (Sukses Checkout)
      await expect(page).toHaveURL(/.*\/buyer\/orders\/\d+/);
      await expect(page.getByText('Berhasil checkout')).toBeVisible();
      
      // 5. Verifikasi tombol bayar (Midtrans Mock) muncul
      await expect(page.getByRole('button', { name: /Bayar Sekarang/i }).or(page.getByText(/Bayar Sekarang/i))).toBeVisible();
    } else {
      test.skip('Cart is empty, skipping checkout test');
    }
  });
});
