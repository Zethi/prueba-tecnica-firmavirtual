export function capitalizeFirstLetter(stringToCapitalize: string): string {
  return (
    stringToCapitalize.charAt(0).toUpperCase() + stringToCapitalize.slice(1)
  );
}

export function addLeadingZeros(number: number): string {
  let numberString = number.toString();

  if (numberString.length < 3) {
    let zerosToAdd = 3 - numberString.length;

    for (let i = 0; i < zerosToAdd; i++) {
      numberString = "0" + numberString;
    }
  }

  return numberString;
}
