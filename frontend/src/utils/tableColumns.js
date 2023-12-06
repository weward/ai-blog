export const documentsTableColumns = [
  {
    name: 'subject',
    required: true,
    label: 'Keyword',
    align: 'left',
    field: row => row.subject,
    format: val => `${val}`,
    sortable: false,
    value: 'documents'
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
    field: row => row.updated_at.human,
    format: val => `${val}`,
    style: 'width:240px',
    sortable: true
  },
]
