import type { Metadata } from "next";
import "./globals.css";
import { mainFont } from "./fonts";
import { DependencyProvider } from "@/hooks/useDependency";


export const metadata: Metadata = {
  title: "Pokédex | FirmaVirtual",
  description: "Proyecto prueba técnica para FirmaVirtual",
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="es">
      <body
        className={`${mainFont.className} max-h-screen h-screen flex flex-col test overflow-hidden`}
      >
        <DependencyProvider>
          {children}
        </DependencyProvider>
      </body>
    </html >
  );
}
