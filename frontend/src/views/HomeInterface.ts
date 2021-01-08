export interface HomeInterface {
  heroTitle: string;
  heroSub: string;
  heroButton: string;
  heroUrl: string;
  _mby: string;
  _by: string;
  sections: Section[];
  discord: Discord;
}

export interface Discord {
  title: string;
  body: string;
  ctaText: string;
  ctaUrl: string;
  image?: Image;
}

export interface Section {
  value: Value;
}

export interface Value {
  title: string;
  body: string;
  ctaText: string;
  ctaUrl: string;
  image: Image;
}

export interface Image {
  path: string;
  meta: Meta;
}

export interface Meta {
  title: string;
}
