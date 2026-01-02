export async function handler(event) {
  const cpf = event.queryStringParameters?.cpf;

  if (!cpf) {
    return {
      statusCode: 400,
      body: JSON.stringify({ error: "CPF não informado" }),
    };
  }

  const apiUrl = `https://busca-oficial.wuaze.com/api/cpf.php?cpf=${encodeURIComponent(cpf)}`;

  try {
    const res = await fetch(apiUrl);
    const text = await res.text();

    return {
      statusCode: 200,
      headers: {
        "Content-Type": "application/json",
      },
      body: text,
    };
  } catch (err) {
    return {
      statusCode: 500,
      body: JSON.stringify({ error: "Erro ao consultar API externa" }),
    };
  }
}
