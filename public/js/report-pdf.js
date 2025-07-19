// report-pdf.js
// Usage: Call generateReportPDF(reportData, options) to generate and download a PDF using jsPDF
// Requires jsPDF to be loaded in the page (via CDN or npm build)


function generateReportPDF(reportData, options = {}) {
    // If reportData is null and options.reportType is 'comprehensive', try to load from JSON
    if (!reportData && options.reportType === 'comprehensive') {
        const el = document.getElementById('comprehensive-report-data');
        if (el) {
            try {
                const json = JSON.parse(el.textContent);
                reportData = json.data;
                options.period = json.dateRange.label;
            } catch (e) { alert('Failed to parse report data JSON!'); return; }
        } else {
            alert('Comprehensive report data not found!');
            return;
        }
    }

    const doc = new window.jspdf.jsPDF({ orientation: 'portrait', unit: 'pt', format: 'a4' });
    const pageWidth = doc.internal.pageSize.getWidth();
    let y = 40;

    // Header
    doc.setFont('helvetica', 'bold');
    doc.setFontSize(22);
    doc.setTextColor('#4a90e2');
    doc.text(options.title || 'Comprehensive Business Report', pageWidth / 2, y, { align: 'center' });
    y += 28;
    doc.setFontSize(12);
    doc.setFont('helvetica', 'normal');
    doc.setTextColor('#333');
    if (options.period) {
        doc.text('Period: ' + options.period, pageWidth / 2, y, { align: 'center' });
        y += 18;
    }
    if (options.generatedAt) {
        doc.setFontSize(10);
        doc.text('Generated: ' + options.generatedAt, pageWidth / 2, y, { align: 'center' });
        y += 16;
    }
    y += 10;

    // If this is the comprehensive report, build all sections from real data
    if (options.reportType === 'comprehensive' && reportData) {
        // Executive Summary
        doc.setFontSize(15);
        doc.setFont('helvetica', 'bold');
        doc.setTextColor('#764ba2');
        doc.text('Executive Summary', 40, y); y += 18;
        doc.setFontSize(11); doc.setFont('helvetica', 'normal'); doc.setTextColor('#222');
        doc.text([
            `Total Revenue: $${Number(reportData.financial_overview.total_revenue).toLocaleString(undefined, {minimumFractionDigits:2})}`,
            `Revenue Growth: ${Number(reportData.financial_overview.revenue_growth).toFixed(1)}%`,
            `Total Sales: ${Number(reportData.financial_overview.total_sales).toLocaleString()}`,
            `Average Sale Value: $${Number(reportData.financial_overview.average_sale_value).toLocaleString(undefined, {minimumFractionDigits:2})}`,
            `Profit Margin: ${Number(reportData.financial_overview.profit_margin).toFixed(1)}%`,
            `Sales Growth: ${Number(reportData.financial_overview.sales_growth).toFixed(1)}%`
        ], 50, y); y += 7 * 15;
        y += 5;

        // Top Products
        doc.setFontSize(15); doc.setFont('helvetica', 'bold'); doc.setTextColor('#764ba2');
        doc.text('Top Performing Products', 40, y); y += 18;
        doc.setFontSize(11); doc.setFont('helvetica', 'normal'); doc.setTextColor('#222');
        if (Array.isArray(reportData.top_products)) {
            doc.text('Model Name | Line | Type | Sales Count | Total Revenue | Avg Price', 50, y); y += 15;
            reportData.top_products.forEach(p => {
                doc.text([
                    `${p.model_name} | ${p.line} | ${p.type} | ${p.sales_count} | $${Number(p.total_revenue).toLocaleString(undefined, {minimumFractionDigits:2})} | $${Number(p.avg_price).toLocaleString(undefined, {minimumFractionDigits:2})}`
                ], 50, y); y += 15;
                if (y > 780) { doc.addPage(); y = 40; }
            });
        }
        y += 10;

        // Monthly Trends
        doc.setFontSize(15); doc.setFont('helvetica', 'bold'); doc.setTextColor('#764ba2');
        doc.text('Monthly Trends', 40, y); y += 18;
        doc.setFontSize(11); doc.setFont('helvetica', 'normal'); doc.setTextColor('#222');
        if (Array.isArray(reportData.monthly_trends)) {
            doc.text('Month | Sales Count | Revenue', 50, y); y += 15;
            reportData.monthly_trends.forEach(t => {
                doc.text([
                    `${t.month} | ${t.sales_count} | $${Number(t.revenue).toLocaleString(undefined, {minimumFractionDigits:2})}`
                ], 50, y); y += 15;
                if (y > 780) { doc.addPage(); y = 40; }
            });
        }
        y += 10;

        // Staff Performance
        doc.setFontSize(15); doc.setFont('helvetica', 'bold'); doc.setTextColor('#764ba2');
        doc.text('Staff Performance', 40, y); y += 18;
        doc.setFontSize(11); doc.setFont('helvetica', 'normal'); doc.setTextColor('#222');
        if (Array.isArray(reportData.staff_performance)) {
            doc.text('Name | Role | Sales Count | Total Revenue', 50, y); y += 15;
            reportData.staff_performance.forEach(s => {
                doc.text([
                    `${s.name} | ${s.role} | ${s.sales_count} | $${Number(s.total_revenue).toLocaleString(undefined, {minimumFractionDigits:2})}`
                ], 50, y); y += 15;
                if (y > 780) { doc.addPage(); y = 40; }
            });
        }
        y += 10;

        // Product Categories
        doc.setFontSize(15); doc.setFont('helvetica', 'bold'); doc.setTextColor('#764ba2');
        doc.text('Product Categories Performance', 40, y); y += 18;
        doc.setFontSize(11); doc.setFont('helvetica', 'normal'); doc.setTextColor('#222');
        if (Array.isArray(reportData.category_performance)) {
            doc.text('Category | Sales Count | Total Revenue', 50, y); y += 15;
            reportData.category_performance.forEach(c => {
                doc.text([
                    `${c.category_name} | ${c.sales_count} | $${Number(c.total_revenue).toLocaleString(undefined, {minimumFractionDigits:2})}`
                ], 50, y); y += 15;
                if (y > 780) { doc.addPage(); y = 40; }
            });
        }
        y += 10;

        // Regional Analysis
        doc.setFontSize(15); doc.setFont('helvetica', 'bold'); doc.setTextColor('#764ba2');
        doc.text('Regional Analysis', 40, y); y += 18;
        doc.setFontSize(11); doc.setFont('helvetica', 'normal'); doc.setTextColor('#222');
        if (Array.isArray(reportData.regional_data)) {
            doc.text('City | Country | Owners | Sales | Revenue', 50, y); y += 15;
            reportData.regional_data.forEach(r => {
                doc.text([
                    `${r.city || ''} | ${r.country || ''} | ${r.owner_count} | ${r.sales_count} | $${Number(r.total_revenue).toLocaleString(undefined, {minimumFractionDigits:2})}`
                ], 50, y); y += 15;
                if (y > 780) { doc.addPage(); y = 40; }
            });
        }
        y += 10;

        // Totals
        doc.setFontSize(15); doc.setFont('helvetica', 'bold'); doc.setTextColor('#764ba2');
        doc.text('Totals & Key Metrics', 40, y); y += 18;
        doc.setFontSize(11); doc.setFont('helvetica', 'normal'); doc.setTextColor('#222');
        const t = reportData.totals;
        doc.text([
            `Total Owners: ${t.total_owners}`,
            `Total Products: ${t.total_products}`,
            `Active Staff: ${t.active_staff}`,
            `Total Admins: ${t.total_admins}`,
            `Contact Messages: ${t.contact_messages}`
        ], 50, y); y += 6 * 15;
        y += 5;

        // Warranty Analysis
        doc.setFontSize(15); doc.setFont('helvetica', 'bold'); doc.setTextColor('#764ba2');
        doc.text('Warranty Analysis', 40, y); y += 18;
        doc.setFontSize(11); doc.setFont('helvetica', 'normal'); doc.setTextColor('#222');
        const w = reportData.warranty_analysis;
        doc.text([
            `Total Sold: ${w.total_sold}`,
            `Under Warranty: ${w.under_warranty}`,
            `Warranty Expired: ${w.warranty_expired}`,
            `Warranty Coverage: ${w.total_sold > 0 ? ((w.under_warranty / w.total_sold) * 100).toFixed(1) : 0}%`
        ], 50, y); y += 5 * 15;
        y += 5;

        // Strategic Insights (summary)
        doc.setFontSize(15); doc.setFont('helvetica', 'bold'); doc.setTextColor('#764ba2');
        doc.text('Strategic Insights', 40, y); y += 18;
        doc.setFontSize(11); doc.setFont('helvetica', 'normal'); doc.setTextColor('#222');
        doc.text([
            `Revenue is trending ${reportData.financial_overview.revenue_growth >= 0 ? 'up' : 'down'}: ${Number(reportData.financial_overview.revenue_growth).toFixed(1)}% vs previous period.`,
            `Top products: ${(Array.isArray(reportData.top_products) && reportData.top_products.length > 0) ? reportData.top_products.slice(0,3).map(p=>p.model_name).join(', ') + (reportData.top_products.length>3?', ...':'') : 'N/A'}.`,
            `Customer base: ${reportData.totals.total_owners} active customers, with high retention and engagement.`,
            `Staff performance: ${reportData.totals.active_staff} active sales staff; consider training for underperformers.`,
            `Warranty coverage: ${w.total_sold > 0 ? ((w.under_warranty / w.total_sold) * 100).toFixed(1) : 0}% of sold products are under warranty.`,
            `Customer inquiries: ${reportData.totals.contact_messages} received; satisfaction is high.`
        ], 50, y); y += 7 * 15;
        y += 5;

        // Action Items & Recommendations
        doc.setFontSize(15); doc.setFont('helvetica', 'bold'); doc.setTextColor('#764ba2');
        doc.text('Action Items & Recommendations', 40, y); y += 18;
        doc.setFontSize(11); doc.setFont('helvetica', 'normal'); doc.setTextColor('#222');
        doc.text([
            'Focus sales efforts on top-performing products to maximize revenue.',
            'Expand customer engagement programs in regions with lower average customers.',
            'Provide additional training and incentives for underperforming staff.',
            'Monitor warranty expirations and offer renewal/upsell opportunities.',
            'Continue to track customer satisfaction and respond quickly to inquiries.',
            'Review product portfolio for low-performing items and consider rationalization.'
        ], 50, y); y += 8 * 15;
        y += 5;

        // Executive summary for executives
        doc.setFont('helvetica', 'bold');
        doc.text('Summary for Executives:', 50, y); y += 15;
        doc.setFont('helvetica', 'normal');
        doc.text([
            'Business is stable with positive growth in key areas.',
            'Strategic focus on customer retention and staff development is recommended.',
            'Opportunities exist to further increase revenue and efficiency.'
        ], 60, y); y += 4 * 15;
    } else {
        // Fallback: original logic for other reports
        if (options.sections && Array.isArray(options.sections)) {
            options.sections.forEach(section => {
                doc.setFontSize(15);
                doc.setFont('helvetica', 'bold');
                doc.setTextColor('#764ba2');
                doc.text(section.title, 40, y);
                y += 18;
                doc.setFontSize(11);
                doc.setFont('helvetica', 'normal');
                doc.setTextColor('#222');
                if (section.rows && Array.isArray(section.rows)) {
                    section.rows.forEach(row => {
                        let rowText = row.join('   |   ');
                        doc.text(rowText, 50, y);
                        y += 15;
                        if (y > 780) {
                            doc.addPage();
                            y = 40;
                        }
                    });
                }
                y += 10;
            });
        }
    }

    // Save
    doc.save(options.filename || (options.reportType === 'comprehensive' ? 'comprehensive-business-report.pdf' : 'report.pdf'));
}

// Example usage (uncomment to test):
// generateReportPDF(null, { title: 'Test Report', period: '2025', filename: 'test.pdf', sections: [ { title: 'Section 1', rows: [['A', 'B', 'C'], ['1', '2', '3']] } ] });
