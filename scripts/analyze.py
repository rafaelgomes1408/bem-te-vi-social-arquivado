"""
Script para análise de texto usando o modelo BERT treinado.
"""

import json
import sys
from transformers import AutoTokenizer, AutoModelForSequenceClassification, pipeline

# Caminho do modelo treinado
MODEL_PATH = (
    r"C:\laragon\www\bert-imbau\Ambiente_Treinamento_BERTimbau_HateBR\results\checkpoint-2100"
)

# Mapeamento de rótulos para termos mais significativos
LABEL_MAPPING = {
    "LABEL_0": "Aceitável",
    "LABEL_1": "Ofensivo",
}

def analyze_text(text):
    """
    Realiza a análise de texto usando o modelo BERT treinado.

    :param text: Texto para análise.
    :return: Resultado da análise.
    """
    try:
        # Carregar o modelo e o tokenizer
        tokenizer = AutoTokenizer.from_pretrained(MODEL_PATH)
        model = AutoModelForSequenceClassification.from_pretrained(MODEL_PATH)

        # Criar o pipeline de análise
        nlp_pipeline = pipeline("text-classification", model=model, tokenizer=tokenizer)

        # Analisar o texto e traduzir os rótulos
        raw_results = nlp_pipeline(text)
        for item in raw_results:
            item["label"] = LABEL_MAPPING.get(item["label"], "Desconhecido")
        return raw_results
    except Exception as e:
        raise RuntimeError(f"Erro ao carregar modelo ou analisar texto: {str(e)}") from e


if __name__ == "__main__":
    # Verificar se o texto foi fornecido
    if len(sys.argv) < 2:
        print(json.dumps({"status": "error", "message": "Nenhum texto fornecido para análise."}))
        sys.exit(1)

    # Obter o texto do argumento da linha de comando
    input_text = sys.argv[1]

    try:
        # Realizar a análise
        result = analyze_text(input_text)

        # Retornar o resultado no formato JSON com codificação UTF-8
        print(
            json.dumps({"status": "success", "result": result}, ensure_ascii=False, indent=4)
        )

    except RuntimeError as e:
        # Retornar erros no formato JSON com codificação UTF-8
        print(
            json.dumps({"status": "error", "message": str(e)}, ensure_ascii=False).encode("utf-8").decode("utf-8")
        )
