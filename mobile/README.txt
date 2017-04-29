/*******************************************************

	Sinx for Association V 0.93.4
	Gestionale per Associazioni senza scopo di lucro
	http://www.sinx.it
	
********************************************************

SITUAZIONE LEGALE
--------------------------------------------------------
	Rilasciato tramite GNU GPL V3(General Public License).
	Maggiori informazioni http://www.gnu.org/licenses/gpl.txt

	Nessuna garanzia. Nessun supporto. Questa è la beta.

È possibile utilizzare e / o modificare qualsiasi parte del codice.


REQUISITI
--------------------------------------------------------
	Apache
	PHP 4.1+
	MySql


ISTRUZIONI PER L'INSTALLAZIONE
--------------------------------------------------------

1. 	Dopo aver scaricato e decompresso il file di origine,
	Copiarlo nella directory principale del vostro dominio
	
2.	Preparare il database seguendo le istruzioni contenute
	all'interno in particolare leggere attentamente il file
	ManPrepServer.php e/o ManPrepServerext.php a seconda del
	tipo d'installazione

3.	In alternativa al file è presente il manuale in pdf

4.	Avviare l'installer con il comando http://propriodominio/Install

5.	Seguiti tutti i passi del manuale è possibile avviare il
	programma
	
	
	
NEW V0.96.5
--------------------------------------------------------
*	01/10/2013
	Riscrittura del codice del menù
	
	Avvio del modulo di backup esterno
	
	Rivisitazione dei modelli con ampliamento e
	semplificazione per la compilazione
	
	Versione grafica della stampa delle ricevute
	
	Rivisitazione del calendario con avviso dei compleanni
	
	Creazione del modulo dei log di sistema
	
	Correzione del codice e pulitura generale
	
	Avviato resoconto economico
	
	Iniziato scrittura per il multiliguaggio e per il
	modulo progetti
	
	
NEW V0.93.4
--------------------------------------------------------
*	05/07/2012
	Attivato il modulo dello stato patrimoniale

*	12/05/2012
	Nuova veste grafica dell'Header e logo modificato

*	05/04/2012
	Inserito la "stampa scheda associato", inserito
	suggerimenti per la semplificazione delle compilazioni
	dei moduli, Sistemazione piccoli bachi e dimenticanze

*	28/03/2012
	Aggiunto la rubrica associati, calendario nel menù
	attivo, inserito nuovo modulo "conto economico"

*	06/01/2012
	ridefinito la pagina dei moduli, riviso alcuni
	moduli, rifatto il modulo calendario

*	05/01/2012
	Correzioni codice per adattamento html5 per
	tablet e smartphone, inserito la voce 'note' nelle
	anagrafi, aggiunta colonna nel
	db: ALTER TABLE `tb_anagrafe` ADD COLUMN note VARCHAR(200) AFTER tipologia;

*	31/12/2011
	Perfezionata sezione 'Stampa Libro soci', Aggiunto scheda
	dettagliata anche per i contatti esterni ("Altri"),
	Migliorate le liste soci e fondatori

NEW V0.93
--------------------------------------------------------
*	Inserito il calendario per appuntamenti, completato il
	modulo Conto Economico e collegato alla prima Nota,
	ricevute e Fatture

NEW v0.91
--------------------------------------------------------

*	Creato il modulo Fatture che permette
	di inserire, stampare, modificare e registrare il pagamento
	in prima nota delle fatture.
*	E' stato fatto anche qualche miglioramento grafico e
	proseguito con il manuale integrato nel software.	


NEW v0.90
--------------------------------------------------------

*	Nuovo rilascio del software con implementazioni di sicurezza.
*	Gestione multiutente a due livelli.
*	Modificato il calendario appuntamenti.
*	Implementato la sicurezza del codice.
	


CONTATTI
--------------------------------------------------------

Per informazioni:
info@sinx.it - http://www.sinx.it
