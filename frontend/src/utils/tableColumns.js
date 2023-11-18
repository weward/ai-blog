export const documentsTableColumns = [
  {
    name: 'keyword',
    required: true,
    label: 'Keyword',
    align: 'left',
    field: row => row.keyword,
    format: val => `${val}`,
    sortable: false
  },
  {
    name: 'summary',
    required: true,
    label: 'Summary',
    align: 'left',
    field: row => row.summary,
    format: val => `${val}`,
    sortable: false
  },
  {
    name: 'updated_at',
    required: true,
    label: 'Last Updated',
    align: 'right',
    field: row => row.updated_at,
    format: val => `${val}`,
    sortable: true
  },
]
