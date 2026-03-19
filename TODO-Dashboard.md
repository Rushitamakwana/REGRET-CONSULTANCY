# Admin Dashboard Redesign TODO

**Current Status**: Services stats implemented (Total/Active/Inactive Services + Projects). User wants best design with relevant admin data.

**Plan** (My recommendation for modern, useful dashboard):
1. [x] Services stats (Total, Active, Inactive)
2. [ ] Add: Applications (Total, New) - Job applications
3. [ ] Add: Contacts (Total, Unread)
4. [ ] Add: Portfolios (Total, Active)
5. [ ] Design: Responsive cards, charts, recent activity table
6. [ ] Update controller & view for all stats

**Data Sources**:
- Services: ✅ Live counts
- Applications: JobApplication::count(), where('status', 'pending')
- Contacts: Contact::count(), where('status', 'unread')
- Portfolios: Portfolio::count()
- Recent: Latest 5 services/applications/contacts

Proceed with full dashboard redesign?

