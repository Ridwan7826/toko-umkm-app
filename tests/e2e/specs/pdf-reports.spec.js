import { test, expect } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage.js';
import * as fs from 'fs';
import * as path from 'path';

test.describe('PDF Reports Export Module', () => {
  let loginPage;
  const outputDir = path.resolve('docs/testing/pdf-output');

  test.beforeAll(() => {
    if (!fs.existsSync(outputDir)) {
      fs.mkdirSync(outputDir, { recursive: true });
    }
  });

  test.beforeEach(async ({ page }) => {
    loginPage = new LoginPage(page);
    await loginPage.goto();
    // Assuming seller login credentials
    await loginPage.fillCredentials('seller@example.com', 'password');
    await loginPage.submit();
    
    // Wait for login to complete
    await page.waitForURL('**/dashboard');
  });

  test('Seller can download Laporan Penjualan PDF', async ({ page }) => {
    await page.goto('/seller/reports');
    
    const downloadPromise = page.waitForEvent('download');
    // Find the link by partial text or href
    await page.getByRole('link', { name: /Laporan Penjualan/i }).first().click();
    
    const download = await downloadPromise;
    const fileName = download.suggestedFilename();
    
    expect(fileName).toMatch(/Laporan_Penjualan_.*\.pdf$/);
    
    await download.saveAs(path.join(outputDir, fileName));
  });

  test('Seller can download Produk Terlaris PDF', async ({ page }) => {
    await page.goto('/seller/reports');
    
    const downloadPromise = page.waitForEvent('download');
    await page.getByRole('link', { name: /Produk Terlaris/i }).click();
    
    const download = await downloadPromise;
    const fileName = download.suggestedFilename();
    
    expect(fileName).toMatch(/Laporan_Produk_Terlaris_.*\.pdf$/);
    
    await download.saveAs(path.join(outputDir, fileName));
  });

  test('Seller can download Estimasi Pendapatan PDF', async ({ page }) => {
    await page.goto('/seller/reports');
    
    const downloadPromise = page.waitForEvent('download');
    await page.getByRole('link', { name: /Estimasi Pendapatan/i }).click();
    
    const download = await downloadPromise;
    const fileName = download.suggestedFilename();
    
    expect(fileName).toMatch(/Laporan_Estimasi_Pendapatan_.*\.pdf$/);
    
    await download.saveAs(path.join(outputDir, fileName));
  });

  test('Seller can download Pelanggan Loyal PDF', async ({ page }) => {
    await page.goto('/seller/reports');
    
    const downloadPromise = page.waitForEvent('download');
    await page.getByRole('link', { name: /Pelanggan Loyal/i }).click();
    
    const download = await downloadPromise;
    const fileName = download.suggestedFilename();
    
    expect(fileName).toMatch(/Laporan_Pelanggan_Loyal_.*\.pdf$/);
    
    await download.saveAs(path.join(outputDir, fileName));
  });

  test('Seller can download Invoice PDF from Order Detail', async ({ page }) => {
    // Navigate to order list first to find an order id
    await page.goto('/seller/orders');
    
    // Check if there's any order detail link
    const detailLink = page.getByRole('link', { name: /Detail/i }).first();
    const isVisible = await detailLink.isVisible();
    
    if (isVisible) {
        await detailLink.click();
        
        const downloadPromise = page.waitForEvent('download');
        await page.getByRole('link', { name: /Cetak Invoice \(PDF\)/i }).click();
        
        const download = await downloadPromise;
        const fileName = download.suggestedFilename();
        
        expect(fileName).toMatch(/.*\.pdf$/);
        await download.saveAs(path.join(outputDir, fileName));
    } else {
        // Skip or console log if no orders
        console.log('No orders found to test Invoice PDF download');
    }
  });
});
