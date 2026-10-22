const BREVO_CONTACTS_URL = 'https://api.brevo.com/v3/contacts';
const BREVO_LIST_ID = 2;

module.exports = async function subscribe(req, res) {
	if (req.method !== 'POST') {
		res.setHeader('Allow', 'POST');
		return res.status(405).json({ error: 'Method not allowed.' });
	}

	const body = req.body;
	if (!body || typeof body !== 'object' || Array.isArray(body)) {
		return res.status(400).json({ error: 'A valid JSON request body is required.' });
	}

	const { name, email, consent, website } = body;
	if (
		typeof name !== 'string' ||
		typeof email !== 'string' ||
		typeof website !== 'string' ||
		typeof consent !== 'boolean'
	) {
		return res.status(400).json({ error: 'Please provide a valid name, email address, and consent.' });
	}

	const cleanName = name.trim();
	const cleanEmail = email.trim();
	const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
	if (
		cleanName.length === 0 ||
		cleanName.length > 100 ||
		cleanEmail.length > 254 ||
		!emailPattern.test(cleanEmail) ||
		consent !== true
	) {
		return res.status(400).json({ error: 'Please provide a valid name, email address, and consent.' });
	}

	if (website.trim() !== '') {
		return res.status(400).json({ error: 'The signup could not be accepted.' });
	}

	const apiKey = process.env.BREVO_API_KEY;
	if (typeof apiKey !== 'string' || apiKey.trim() === '') {
		console.error('BREVO_API_KEY is not configured.');
		return res.status(503).json({ error: 'Newsletter signup is temporarily unavailable.' });
	}

	let brevoResponse;
	try {
		brevoResponse = await fetch(BREVO_CONTACTS_URL, {
			method: 'POST',
			headers: {
				accept: 'application/json',
				'content-type': 'application/json',
				'api-key': apiKey.trim()
			},
			body: JSON.stringify({
				email: cleanEmail,
				attributes: {
					FIRSTNAME: cleanName
				},
				listIds: [BREVO_LIST_ID],
				updateEnabled: true
			})
		});
	} catch (error) {
		console.error('Brevo request failed:', error);
		return res.status(502).json({ error: 'Newsletter signup could not be completed. Please try again later.' });
	}

	if (!brevoResponse.ok) {
		console.error('Brevo returned status', brevoResponse.status);
		return res.status(502).json({ error: 'Newsletter signup could not be completed. Please try again later.' });
	}

	return res.status(brevoResponse.status).json({ success: true });
};
