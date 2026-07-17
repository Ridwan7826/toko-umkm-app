import { expect } from '@playwright/test';
export class DashboardPage {
    constructor(page) { this.page = page; }
    async verifyRole(role) { await expect(this.page.getByText('Role: ' + role)).toBeVisible(); }
    async gotoMenu(menuName) { await this.page.getByText(menuName, { exact: true }).click(); }
}
