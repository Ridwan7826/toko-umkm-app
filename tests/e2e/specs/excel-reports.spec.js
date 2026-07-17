import { test, expect } from '@playwright/test';
import { LoginPage } from '../pages/LoginPage.js';
import * as fs from 'fs';
import * as path from 'path';

test.describe('Excel Reports Export Module', () => {
  const outputDir = path.resolve('docs/testing/spreadsheet-output');

  test.beforeAll(() => {
    if (!fs.existsSync(outputDir)) {
      fs.mkdirSync(outputDir, { recursive: true });
    }
  });

  test.describe('Seller Excel Reports', () => {
    let loginPage;
    
    test.beforeEach(async ({ page }) => {
      loginPage = new LoginPage(page);
      await loginPage.goto();
      await loginPage.fillCredentials('seller@example.com', 'password');
      await loginPage.submit();
      await page.waitForURL('**/dashboard');
    });

    test('Seller can download Laporan Penjualan Excel', async ({ page }) => {
      await page.goto('/seller/reports');
      
      const downloadPromise = page.waitForEvent('download');
      // Locator for the specific excel download link
      await page.getByRole('link', { name: /Laporan Penjualan Keseluruhan/i }).click();
      
      const download = await downloadPromise;
      const fileName = download.suggestedFilename();
      
      expect(fileName).toMatch(/Laporan_Penjualan_.*\.xlsx$/);
      
      await download.saveAs(path.join(outputDir, fileName));
    });

    test('Seller can download Stok Produk Menipis Excel', async ({ page }) => {
      await page.goto('/seller/reports');
      
      const downloadPromise = page.waitForEvent('download');
      await page.getByRole('link', { name: /Stok Produk Menipis/i }).click();
      
      const download = await downloadPromise;
      const fileName = download.suggestedFilename();
      
      expect(fileName).toMatch(/Laporan_Stok_Menipis_.*\.xlsx$/);
      
      await download.saveAs(path.join(outputDir, fileName));
    });

    test('Seller can download Pembatalan Pesanan Excel', async ({ page }) => {
      await page.goto('/seller/reports');
      
      const downloadPromise = page.waitForEvent('download');
      await page.getByRole('link', { name: /Pembatalan Pesanan/i }).click();
      
      const download = await downloadPromise;
      const fileName = download.suggestedFilename();
      
      expect(fileName).toMatch(/Laporan_Pembatalan_Pesanan_.*\.xlsx$/);
      
      await download.saveAs(path.join(outputDir, fileName));
    });
  });

  test.describe('Admin Excel Reports', () => {
    let loginPage;
    
    test.beforeEach(async ({ page }) => {
      loginPage = new LoginPage(page);
      await loginPage.goto();
      await loginPage.fillCredentials('admin@tokokita.com', 'password');
      await loginPage.submit();
      await page.waitForURL('**/dashboard');
    });

    test('Admin can download Laporan Transaksi Platform Excel', async ({ page }) => {
      await page.goto('/admin/reports');
      
      const downloadPromise = page.waitForEvent('download');
      await page.getByRole('link', { name: /Download Laporan \(Excel\)/i }).click();
      
      const download = await downloadPromise;
      const fileName = download.suggestedFilename();
      
      expect(fileName).toMatch(/Laporan_Transaksi_Platform\.xlsx$/);
      
      await download.saveAs(path.join(outputDir, fileName));
    });
  });
});
